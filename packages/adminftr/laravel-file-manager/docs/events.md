# Events

### BeforeInitialization

> Future\FileManager\Events\BeforeInitialization

Example:

```php
\Event::listen(' Future\FileManager\Events\BeforeInitialization',
    function ($event) {
        
    }
);
```

### DiskSelected

> Future\FileManager\Events\DiskSelected

Example:

```php
\Event::listen(' Future\FileManager\Events\DiskSelected',
    function ($event) {
        \Log::info('DiskSelected:', [$event->disk()]);
    }
);
```

### FilesUploading

> Future\FileManager\Events\FilesUploading

```php
\Event::listen(' Future\FileManager\Events\FilesUploading',
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

> Future\FileManager\Events\FilesUploaded

```php
\Event::listen(' Future\FileManager\Events\FilesUploaded',
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

> Future\FileManager\Events\Deleting

```php
\Event::listen(' Future\FileManager\Events\Deleting',
    function ($event) {
        \Log::info('Deleting:', [
            $event->disk(),
            $event->items(),
        ]);
    }
);
```

### Deleted

> Future\FileManager\Events\Deleted

```php
\Event::listen(' Future\FileManager\Events\Deleted',
    function ($event) {
        \Log::info('Deleted:', [
            $event->disk(),
            $event->items(),
        ]);
    }
);
```

### Paste

> Future\FileManager\Events\Paste

```php
\Event::listen(' Future\FileManager\Events\Paste',
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

> Future\FileManager\Events\Rename

```php
\Event::listen(' Future\FileManager\Events\Rename',
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

> Future\FileManager\Events\Download

```php
\Event::listen(' Future\FileManager\Events\Download',
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

> Future\FileManager\Events\DirectoryCreating

```php
\Event::listen(' Future\FileManager\Events\DirectoryCreating',
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

> Future\FileManager\Events\DirectoryCreated

```php
\Event::listen(' Future\FileManager\Events\DirectoryCreated',
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

> Future\FileManager\Events\FileCreating

```php
\Event::listen(' Future\FileManager\Events\FileCreating',
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

> Future\FileManager\Events\FileCreated

```php
\Event::listen(' Future\FileManager\Events\FileCreated',
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

> Future\FileManager\Events\FileUpdate

```php
\Event::listen(' Future\FileManager\Events\FileUpdate',
    function ($event) {
        \Log::info('FileUpdate:', [
            $event->disk(),
            $event->path(),
        ]);
    }
);
```

### Zip

> Future\FileManager\Events\Zip

```php
\Event::listen(' Future\FileManager\Events\Zip',
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

> Future\FileManager\Events\ZipCreated

```php
\Event::listen(' Future\FileManager\Events\ZipCreated',
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

> Future\FileManager\Events\ZipCreated

```php
\Event::listen(' Future\FileManager\Events\ZipFailed',
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

> Future\FileManager\Events\Unzip

```php
\Event::listen(' Future\FileManager\Events\Unzip',
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

> Future\FileManager\Events\UnzipCreated

```php
\Event::listen(' Future\FileManager\Events\UnzipCreated',
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

> Future\FileManager\Events\UnzipFailed

```php
\Event::listen(' Future\FileManager\Events\UnzipFailed',
    function ($event) {
        \Log::info('UnzipFailed:', [
            $event->disk(),
            $event->path(),
            $event->folder(),
        ]);
    }
);
```
