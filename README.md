
# Queue and storage

 Projeto criado com o intuito de aprender como funciona o trabalho com queues em laravel. Em adição, também farei o uso do storage local para salvar fotos.

## Storage local

### Configuração

- Criando link simbólico para que seja possível acessar as fotos pela public/
```sh
php artisan storage:link
```

- Salvando imagens aleatórias para fim de testes

```php
$fileManager = new App\Models\FileManager(new Client());
$fileManager->saveRandomPhoto();
```

## Queues

### Configuração

- No arquivo `.env` mude o valor de QUEUE_CONNECTION para `database`