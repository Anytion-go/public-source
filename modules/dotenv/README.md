# Dotenv

## Library for PHP

---

### menu

[Get started](#get-started)

[install](#install)

---

### Get started

#### การ `require` เข้ามาใช้งาน และ `config`

- dotenv เป็นตัวที่ต้อง require หรือ import เพียงครั้งเดียว 

- หลังจาก require เข้ามาแล้ว ต้องใช้ `config` ดังนี้

- ใช้ `use-import` Library
    ```php
    $dotenv = import('dotenv');
    $dotenv->config();
    ```
    หรือ 
    ```php
    import('dotenv')->config();
    ```
    -
- ใช้ `require` 

    ```php
    $dotenv = require('./modules/dotenv/main.m.php');
    $dotenv->config();
    ```
    หรือ
    ```php
    (require('./modules/dotenv/main.m.php'))->config();
    ```

- หากไฟล์ `.env` ไม่ได้เป็นชื่อ `.env` ตามปกติ แต่เป็นแบบอื่น เช่น `.example.env` สามารถใส่ชื่อลงใน `config` ได้

    ```php
    $dotenv->config('example.env');
    ```

### การเข้าถึงข้อมูล 
- สามารถใช้ `$_ENV` เข้าถึงค่าต่างๆ ได้ตามปกติหลังจากทำการ `config`
- เช่น 
```
// .env
host=localhost
```

```php
// index.php
echo $_ENV['host'];
```

---

### install
- ใช้ [control](https://github.com/arikato111/control) ในการติดตั้ง โดยหลังจากทำการลง control เรียบร้อยให้ใช้คำสั่งด้านล่าง

```
php control install dotenv
```