# Events

### BeforeInitialization

> Adminftr\FileManager\Events\BeforeInitialization

Example:

```php
\Event::listen(' Adminftr\FileManager\Events\BeforeInitialization',
    function ($event) {
        
    }
);
```

### DiskSelected

> Adminftr\FileManager\Events\DiskSelected

Example:

```php
\Event::listen(' Adminftr\FileManager\Events\DiskSelected',
    function ($event) {
        \Log::info('DiskSelected:', [$event->disk()]);
    }
);
```

### FilesUploading

> Adminftr\FileManager\Events\FilesUploading

```php
\Event::listen(' Adminftr\FileManager\Events\FilesUploading',
    function ($event) {
        \Log::info('FilesUploading:', [
            $event->disk(),
            $event->path(),
            $event->files(),
            $event->overwrite(),
        ]);
    }
);
```

### FilesUploaded

> Adminftr\FileManager\Events\FilesUploaded

```php
\Event::listen(' Adminftr\FileManager\Events\FilesUploaded',
    function ($event) {
        \Log::info('FilesUploaded:', [
            $event->disk(),
            $event->path(),
            $event->files(),
            $event->overwrite(),
        ]);
    }
);
```

### Deleting

> Adminftr\FileManager\Events\Deleting

```php
\Event::listen(' Adminftr\FileManager\Events\Deleting',
    function ($event) {
        \Log::info('Deleting:', [
            $event->disk(),
            $event->items(),
        ]);
    }
);
```

### Deleted

> Adminftr\FileManager\Events\Deleted

```php
\Event::listen(' Adminftr\FileManager\Events\Deleted',
    function ($event) {
        \Log::info('Deleted:', [
            $event->disk(),
            $event->items(),
        ]);
    }
);
```

### Paste

> Adminftr\FileManager\Events\Paste

```php
\Event::listen(' Adminftr\FileManager\Events\Paste',
    function ($event) {
        \Log::info('Paste:', [
            $event->disk(),
            $event->path(),
            $event->clipboard(),
        ]);
    }
);
```

### Rename

> Adminftr\FileManager\Events\Rename

```php
\Event::listen(' Adminftr\FileManager\Events\Rename',
    function ($event) {
        \Log::info('Rename:', [
            $event->disk(),
            $event->newName(),
            $event->oldName(),
            $event->type(), // 'file' or 'dir'
        ]);
    }
);
```

### Download

> Adminftr\FileManager\Events\Download

```php
\Event::listen(' Adminftr\FileManager\Events\Download',
    function ($event) {
        \Log::info('Download:', [
            $event->disk(),
            $event->path(),
        ]);
    }
);
```

*When using a text editor, the file you are editing is also downloaded! And this event is triggered!*

### DirectoryCreating

> Adminftr\FileManager\Events\DirectoryCreating

```php
\Event::listen(' Adminftr\FileManager\Events\DirectoryCreating',
    function ($event) {
        \Log::info('DirectoryCreating:', [
            $event->disk(),
            $event->path(),
            $event->name(),
        ]);
    }
);
```

### DirectoryCreated

> Adminftr\FileManager\Events\DirectoryCreated

```php
\Event::listen(' Adminftr\FileManager\Events\DirectoryCreated',
    function ($event) {
        \Log::info('DirectoryCreated:', [
            $event->disk(),
            $event->path(),
            $event->name(),
        ]);
    }
);
```

### FileCreating

> Adminftr\FileManager\Events\FileCreating

```php
\Event::listen(' Adminftr\FileManager\Events\FileCreating',
    function ($event) {
        \Log::info('FileCreating:', [
            $event->disk(),
            $event->path(),
            $event->name(),
        ]);
    }
);
```

### FileCreated

> Adminftr\FileManager\Events\FileCreated

```php
\Event::listen(' Adminftr\FileManager\Events\FileCreated',
    function ($event) {
        \Log::info('FileCreated:', [
            $event->disk(),
            $event->path(),
            $event->name(),
        ]);
    }
);
```

### FileUpdate

> Adminftr\FileManager\Events\FileUpdate

```php
\Event::listen(' Adminftr\FileManager\Events\FileUpdate',
    function ($event) {
        \Log::info('FileUpdate:', [
            $event->disk(),
            $event->path(),
        ]);
    }
);
```

### Zip

> Adminftr\FileManager\Events\Zip

```php
\Event::listen(' Adminftr\FileManager\Events\Zip',
    function ($event) {
        \Log::info('Zip:', [
            $event->disk(),
            $event->path(),
            $event->name(),
            $event->elements(),
        ]);
    }
);
```

### ZipCreated

> Adminftr\FileManager\Events\ZipCreated

```php
\Event::listen(' Adminftr\FileManager\Events\ZipCreated',
    function ($event) {
        \Log::info('ZipCreated:', [
            $event->disk(),
            $event->path(),
            $event->name(),
            $event->elements(),
        ]);
    }
);
```

### ZipFailed

> Adminftr\FileManager\Events\ZipCreated

```php
\Event::listen(' Adminftr\FileManager\Events\ZipFailed',
    function ($event) {
        \Log::info('ZipFailed:', [
            $event->disk(),
            $event->path(),
            $event->name(),
            $event->elements(),
        ]);
    }
);
```

### Unzip

> Adminftr\FileManager\Events\Unzip

```php
\Event::listen(' Adminftr\FileManager\Events\Unzip',
    function ($event) {
        \Log::info('Unzip:', [
            $event->disk(),
            $event->path(),
            $event->folder(),
        ]);
    }
);
```

### UnzipCreated

> Adminftr\FileManager\Events\UnzipCreated

```php
\Event::listen(' Adminftr\FileManager\Events\UnzipCreated',
    function ($event) {
        \Log::info('UnzipCreated:', [
            $event->disk(),
            $event->path(),
            $event->folder(),
        ]);
    }
);
```

### UnzipFailed

> Adminftr\FileManager\Events\UnzipFailed

```php
\Event::listen(' Adminftr\FileManager\Events\UnzipFailed',
    function ($event) {
        \Log::info('UnzipFailed:', [
            $event->disk(),
            $event->path(),
            $event->folder(),
        ]);
    }
);
```
