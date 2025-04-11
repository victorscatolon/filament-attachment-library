## 🚀 Quickstart & Installation

Follow the steps below to get up and running with **Filament Attachment Library**:

### 1. Create a Laravel project and install Filament

Start by creating a new Laravel project:

```bash
laravel new myProject
```

Then, follow the Filament installation guide:  
🔗 [Filament Installation Documentation](https://filamentphp.com/docs/3.x/panels/installation)

---

### 2. Install the Filament Attachment Library package

Require the package via Composer:

```bash
composer require victorscatolon/filament-attachment-library
```

---

### 3. Publish the package migrations

```bash
php artisan vendor:publish --tag="filament-attachment-library-migrations"
```

---

### 4. Run the migrations

```bash
php artisan migrate
```

---

### 5. Create a Filament user

Create an admin user for accessing the Filament panel.  
Refer to the Filament docs:  
🔗 [Creating a Filament User](https://filamentphp.com/docs/3.x/panels/installation)

---

### 6. Serve your application

```bash
php artisan serve
```

---

## ⚙️ Configuration

### 1. Create your model

```bash
php artisan make:model MyModel
```

---

### 2. Enable attachments on your model

Add the `InteractsWithAttachments` trait to your model to enable polymorphic attachment support:

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\InteractsWithAttachments;

class MyModel extends Model
{
    use InteractsWithAttachments;
}
```

---

### 3. Create a Filament resource for your model

Follow the Filament guide to generate a resource:  
🔗 [Filament Resources - Getting Started](https://filamentphp.com/docs/3.x/panels/resources/getting-started)

---

### 4. Add the file upload field to the resource form

Use the `AttachmentFileUpload` component in your resource form:

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

---

### 5. Handle attachments in resource actions

Add the `HandleAttachments` trait to your `CreateRecord` and `EditRecord` components to properly handle file attachments during create and update operations.

#### CreateRecord Component

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\HandleAttachments;

class CreateMyModel extends CreateRecord
{
    use HandleAttachments;
}
```

#### EditRecord Component

```php
use VictorScatolon\FilamentAttachmentLibrary\Core\HandleAttachments;

class EditMyModel extends EditRecord
{
    use HandleAttachments;
}
```
