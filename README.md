
# Queue and storage

 Projeto criado com o intuito de aprender como funciona o trabalho com queues em laravel. Em adição, também farei o uso do storage local para salvar fotos.

## Storage local

### Configuração

- Criando link simbólico para que seja possível acessar as fotos pela public/
```sh
php artisan storage:link
```

### Execução

- Salvando imagens aleatórias para fim de testes

```php
$fileManager = new App\Models\FileManager(size: 400);
$fileManager->saveRandomPhoto();
```

## Queues

### Configuração

- No arquivo `.env` mude o valor de QUEUE_CONNECTION para `database`
- Executar `php artisan queue:work` para as filas começarem a trabalhar

### Execução

Rota: `/save-photo/{size}`

Essa rota cairá no Controller `FileManager`, que por sua vez faz o _dispatch_ do job `RandomImage` com o delay de 5 segundos

```php
public function savePhoto(Request $request)
{
    RandomImage::dispatch($request->size)->delay(now()->addSecond(5));
}
```

`RandomImage` chamará o método `saveRandomPhoto` da model `FileManager` passando o _size_ informado na requisição

```php
public function handle(FileManager $fileManager)
{
    $fileManager->saveRandomPhoto($this->size);
}
```

O método `saveRandomPhoto` tem como objetivo consumir uma _API_ de geração de fotos aleatórias e salvar a resposta (a imagem) no storage local, na pasta `/public`

```php
public function saveRandomPhoto(int $size)
{
    $response = $this->client->request('GET', "/{$size}");
    Storage::disk('public')->put(uniqid() . '.jpg', $response->getBody());
}
```

* Observação: a propriedade `client` foi configurada para receber um `GuzzleHttp\Client` já com a `base_uri` configurada por meio do `AppServiceProvider`

```php
$this->app->when(FileManager::class)
    ->needs(Client::class)
    ->give(function () {
        return new Client([
            'base_uri' => 'https://picsum.photos'
        ]);
    });
```