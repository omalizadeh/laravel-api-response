# Laravel Api Response

Basic and standard api response format for laravel using json resources.

## Installation

```bash
composer require omalizadeh/laravel-api-response
```

## Output Format

Resources:

```json
{
    "data": {
        "id": 1,
        "email": "test@test.com"
    },
    "message": "message",
    "errors": {
        "password": [
            "wrong password."
        ]
    }
}
```

ResourceCollection:

```json
{
    "data": {
        "items": [],
        "count": 0,
        "sum": null
    },
    "message": null,
    "errors": null
}
```

On validation error for requests (with 422 status code):

```json
{
    "data": null,
    "message": "first error message in message bag",
    "error": {
        "password": [
            "password field is required."
        ]
    }
}
```

## Usage

Create resources and requests with artisan commands and pass data, message or count to resources like following
examples:

```php
    public function index(EmailFilter $filters)
    {
        $emailsFilterResult = Email::filter($filters);
        
        return EmailResource::collection([
            'data' => $emailsFilterResult->data(),
            'count' => $emailsFilterResult->count(),
        ]);
    }
```

```php
    public function show(Email $email)
    {
        return new EmailResource(['data' => $email, 'message'=> 'email info.']);
    }
```

You can specify output fields from transformDataItem() method of resource classes.

```php
<?php

namespace App\Http\Resources;

use Omalizadeh\ApiResponse\Resources\BaseApiResource;

class EmailResource extends BasicResource
{
    protected function transformDataItem($item)
    {
        return [
            'id' => $item->id,
            'email' => $item->email,
            'status' => $item->status
        ];
    }
}

```

Also, you can use apiResponse() helper function to directly send response

```php
class PhoneController 
{
    public function show(Phone $phone)
    {
        return apiResponse()->data($phone)->message('phone info.')->status(200)->get();
    }
    
    public function index() 
    {
        $phones = Phone::all();
        
        return apiResponse()->collection($phones, $phones->count())->message('phone info.')->status(200)->get();
    }
    
    public function update(Request $request, Phone $phone) 
    {
        $isUpdated = $phone->update($request->all());
        
        if (!$isUpdated) {
            return apiResponse()->errorMessage('phone is not updated');
        }
        
        return apiResponse()->data($phone)->message('phone is updated')->get();
    }
}
```

In above example **message** and **status** are optional, and their default value respectively are `null` and `200`.

#### Resource

```bash
php artisan make:api-resource ResourceClassName
```

#### Request

```bash
php artisan make:api-request RequestClassName
```
