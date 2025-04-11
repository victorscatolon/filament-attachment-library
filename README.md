# Filament Attachment Library

Filament Attachment Library is a Laravel package that enables a polymorphic morphMany relationship to handle file attachments across multiple Eloquent models. Seamlessly integrated with Filament, it offers a clean, reusable, and consistent approach to managing file uploads through Filament resource forms and tables—making attachment handling simple and scalable across your application.

## 🚀 Installation

Install the package via Composer:

```bash
composer require victorscatolon/filament-attachment-library
```

Then publish the package's migration files:

```bash
php artisan vendor:publish --tag="filament-attachment-library-migrations"
```

## ⚙️ Configuration

1. Create your model
   If you haven’t already, create a new Eloquent model:

```bash
php artisan make:model MyModel
```

2. Enable attachments on your model
   Add the `InteractsWithAttachments` trait to your model to define the polymorphic relationship:

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\InteractsWithAttachments;

class MyModel extends Model
{
    use InteractsWithAttachments;
}
```

3. Add the file upload field to your Filament form
   In your Filament resource's `form` method, include the `AttachmentLibraryFileUpload` component to allow users to upload files:

```php
use VictorScatolon\FilamentAttachmentLibrary\Forms\Components\AttachmentLibraryFileUpload;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            AttachmentLibraryFileUpload::make(),
        ]);
}
```

4. Enable attachment handling in the CreateRecord component
   To ensure attachments are saved properly when creating a new model, use the `HandleAttachments` trait in your `CreateRecord` class:

**CreateRecord component**

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\HandleAttachments;

class CreateMyModel extends CreateRecord
{
    use HandleAttachments;
}
```

5. Enable attachment handling in the EditRecord component
   Likewise, use the HandleAttachments trait in your EditRecord class to manage attachments during updates:

**EditRecord component**

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\HandleAttachments;

class EditMyModel extends EditRecord
{
    use HandleAttachments;
}
```

## 🗂️ Relation Managers

To use the Attachment Library within a Relation Manager form, follow these steps:

1. Use the HandleAttachments trait
   Add the `HandleAttachments` trait to your `RelationManager` class:

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\HandleAttachments;

class MyRelationManager extends RelationManager
{
    use HandleAttachments;
}
```

2. Set `dehydrated(true)` on the file upload field
   Make sure the attachment field is dehydrated so that the file data is available during form processing:

```php
public function form(Form $form): Form
{
    return $form
        ->schema([
            AttachmentFileUpload::make()->dehydrated(true),
        ]);
}
```

3. Add a custom create action to the table
   You’ll need to define a custom `CreateAction` with an `after()` callback to manually handle the attachments after the record is created:

```php
public function table(Table $table): Table
{
    return $table->headerActions([
            Tables\Actions\CreateAction::make()
                ->after(function ($record, $data) {
                    $attachments = $data['attachments'];
                    $this->handleAttachments($record, $attachments);
                }),
        ]);
}
```

✅ Note: Make sure the field name in the $data array matches the field key used in the AttachmentLibraryFileUpload::make() definition.

## 📦 Changelog

For a detailed list of recent changes, updates, and improvements, please refer to the [Changelog](https://github.com/victorscatolon/filament-attachment-library/blob/main/CHANGELOG.md).

## 🤝 Contributing

Contributions are welcome! To get started, please read the [Contribution Guide](https://github.com/victorscatolon/filament-attachment-library/blob/main/CONTRIBUTING.md).

## 👨‍💻 Credits

Developed and maintained by [@victorscatolon](https://github.com/victorscatolon).  
Thanks to all the amazing contributors who help improve this package.

## 📄 License

This project is open-source software licensed under the [MIT License](https://github.com/victorscatolon/filament-attachment-library/blob/main/LICENSE.md).
