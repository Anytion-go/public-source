## WISIOS
### Library for PHP
--- 
### menu

[Get started](#get-started)

[การ require เข้ามาใช้งาน](#การ-require-เข้ามาใช้งาน)

[Method การส่งคำขอ](#method-การส่งคำขอ)

[ส่งข้อมูลให้ api](#ส่งข้อมูลให้-api)

[โครงสร้างข้อมูลที่รับจาก api](#โครงสร้างข้อมูลที่รับจาก-api)

[การตั้งค่า base url](#การตั้งค่า-base-url)

[ติดตั้ง](#ติดตั้ง)

---

### Get started
- นี่คือ module ย่อยที่ใช้ร่วมกับ [PHP_SPA](https://github.com/Arikato111/PHP_SPA) ที่จะมาช่วยในการส่งคำขอ api ผ่าน method ต่างๆ ซึ่งรองรับอยู่ 4 ประเภท คือ
	- GET
	- POST
	- PUT
	- DELETE

---
### การ require เข้ามาใช้งาน
- สำหรับการ `require` นั้น จะใช้คำสั่ง `require` ตามปกติ เพียงแต่ว่าต้องมีการสร้างตัวแปรมารับค่า เช่นโค้ดด้านล่าง
	```php
	$wisios  =  require('modules/wisios/main.m.php');
	```
- และตัวแปรจะมีค่าเป็น object ซึ่งสามารถเรียกใช้ method ต่างๆ ได้

- หากใช้ `use-import` library

	```php
	$wisios = import('wisios');
	```

---

### Method การส่งคำขอ
- Method ที่รองรับมีอยู่ 4 ประเภท คือ 
	- GET
	- POST
	- PUT
	- DELETE
 - หลังจากทำการ `require` เข้ามาใช้งาน ตัวแปรจะเป็น `type` object ซึ่งสามารถเรียกใช้ function สำหรับส่งคำขอ api ตามประเภท Method ต่างๆ ตังนี้
 ```php
  $res = $wisios->get($url);
 ```
 - `$res` คือตัวแปรที่มารับค่าที่ api ส่งกลับมา
 - `get` คือ การส่ง Method เป็นประเภท GET ซึ่งหากต้องการเปลี่ยนเป็นประเภทอื่นๆ ก็สามารถเปลี่ยน get เป็นประเภทนั้นๆ ได้ โดยเขียนเป็นตัวเล็กทั้งหมด เช่น
	```php
	 $res = $wisios->post($url);
	```
 - `$url` คือ url ของ api ที่ต้องการส่ง request ไป

- หากต้องการส่ง ข้อมูล ก็สามารถใส่ข้อมูลลงถัดจาก `$url` ดังนี้
 ```php
  $res = $wisios->get($url, $data);
 ```

 - สามารถ **custom** Method ได้โดยใช้ `Route`

	```php
	$res = $wisios->Route('GET', $url);
	```

---
### ส่งข้อมูลให้ api
#### การส่งคำขอ api นั้นสามารถส่งข้อมูลแบบเต็มๆ ได้ดังนี้
```php
$res = $wisios->get($url, $data, $header);
```
หรือระบุให้ชัดเจนขึ้น

```php
$res = $wisios->get(url: $url,data: $data,header: $header);
```
1 `$data` เป็นข้อมูลที่ส่งผ่าน body สามารถใส่เป็น object หรือ string ก็ได้

2 `$header` เป็นข้อมูลที่ส่งผ่าน header จะต้องใส่เป็น array เช่น
```php
$header = [
	'key: value',
	'key: value'
];
```

---

### โครงสร้างข้อมูลที่รับจาก api

#### หลังจากใช้ `$res = $wisios->get($url);` ตัว `$res` จะมีโครงสร้างเป็น `object` และใช้งานดั้งนี้

- 1 `$res->status` เป็นค่าตัวเลขที่แสดง status code ของ api ที่ส่งมา

- 2 `$res->headers` จะเป็นข้อมูลของ header ที่ส่งมาทาง api มี type เป็น object 

- - *หาก key เป็นอักษรพิเศษสามารถใช้แบบนี้ได้ `$res->headers->{'Content-Type'}`

- 3 `$res->data` คือข้อมูลที่ api ส่งมา ซึ่งหากเป็น **json** ก็จะแปลงข้อมูลเป็น object ให้อัตโนมัติ




---

### การตั้งค่า base url
- โดยปกติแล้วต้องใส่ url แบบเต็มๆ เข้าไป เช่น `https://api.domain.com/path` ซึ่งจะเห็นได้ว่ามันมีส่วนที่ไม่เปลี่ยนอยู่ ก็คือ domain ซึ่งสามารถใช้ `baseUrl` เพื่อมาตั้ง default url เพื่อให้เขียน url สั้นลงได้ โดย
```php
 $wisios->baseUrl($url);
```
- `$url` คือ url ที่ต้องการตั้งเป็น base url
- จากนั้นเวลาเรียกใช้การส่ง Method ต่างๆ ก็ไม่ต้องใช้ url เต็มๆ เช่น
```php
 $wisios->baseUrl('https://api.domain.com');
 $res = $wisios->get('/path');
```
---

### ติดตั้ง
#### ผ่านคำสั่ง php

-   สร้างไฟล์  `installer.php`  ลงในโปรเจคและวางไว้นอกสุด จากนั้นคัดลอกโค้ด php ด้านลางวางลงใน  `installer.php`  จากนั้นเข้าถึงไฟล์ผ่าน เบราว์เซอร์ และรอสักครู่
```php
<?php
eval(file_get_contents('https://raw.githubusercontent.com/Arikato111/wisios/installer/installer.txt'));
```
####  ผ่านคำสั่ง git clone
-   ใช้คำสั่ง  `git clone https://github.com/Arikato111/wisios.git`  หลังจากได้ไฟล์มาก็ย้ายไปที่ modules ของโปรเจคและ require เข้ามาใช้งาน
