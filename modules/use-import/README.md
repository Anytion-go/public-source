# use-import
## การ require รูปแบบใหม่
**เบื่อไหม**กับการ require ของ PHP ที่ทำอย่างกับเอาโค้ดมาแปะ ไม่สามารถสร้างตัวแปรมารับค่าจากการ require ได้ ( ยกเว้นใช้ return ซึ่งยุ่งยาก ) และแล้วคุณไม่ต้องเผชิญแบบนั้นอีกแล้ว! เราขอนำเสนอ use-import library ที่จำทำให้คุณสามารถ require ใส่ตัวแปรได้อย่างง่ายได้ มาพร้อมกับการ export ที่เป็นการส่งต่อค่าออกไปเมื่อ import และยิ่งกว่านั้น มาพร้อมกับการ support การ import modules เข้ามาใช้งานง่ายๆ เพียงใส่ชื่อของ modules ที่ต้องการ 
## การติดตั้ง
- ใช้ [control](https://github.com/Arikato111/control) ในการติดตั้ง
	ใช้คำสั่ง 
	```
	php control install use-import
	```
## การใช้งาน

รุปแบบที่สามารถใช้ได้กับ **directory**
1. `$Home = import('./src/Home');` directory ของไฟล์ที่ใส่เข้าไปนั้นจะต้องอ้างอิงจาก root directory ของโปรเจค แต่หากไม่อยากอ้างอิงจาก root directory ของโปรเจค ใช้วิธีที่ 2
2. `$Home = import(__DIR__,'./Home.php');` วิธีนี้สามารถอ้างอิง directory ของไฟล์ปัจจุบันได้เลย แต่ต้องใส่ **นามสกุลของไฟล์ด้วย**

#### การ import modules

- ตัวอย่าง การ import [wisit-router](https://github.com/Arikato111/wisit-router)

```php

['Route' => $Route] =  import('wisit-router');

```

- สำหรับ `modules` นั้นจะใส่เพียงชื่อของ modules ที่ต้องการเท่านั้น

- หาก modules ที่ต้องการนั้นรองรับการ import แบบ ไฟล์ย่อยๆ ก็สามารถ import ได้ เช่น

```php

$title  =  import('wisit-router/title');

```

- จะสังเกตุว่าไม่ต้องใส่นามสกุลของไฟล์ (.php)

#### การ import ไฟล์ PHP อื่นๆ รวมทั้งไฟล์เว็บแบบฟังค์ชึ่น

- ตัวอย่าง

```php

$HomePage  =  import('./src/Home');

```

- จำเป็นต้องใส่ที่อยู่ไฟล์โดยอ้างอิงจาก path นอกสุดเสมอ และ จำเป็นต้องใส่ `./` หน้าสุดข้องที่อยู่ไฟล์ตามตัวอย่าง

- และ เหมือนกับ modules เมื่อกี้คือ **ไม่ต้องใส่นามสกุลของไฟล์**

- ในหน้า **Home.php** นั้น จะต้องมีการ export ค่าที่จะ import มาใช้งาน เช่น
```php
<?php
$title  =  import('preact/title');

$Home  =  function () use ($title) {
	$title('Home'); // use title function to change title
	return  <<<HTML
		<div>
			<div>Hello world</div>
		</div>
	HTML;
};  

$export  =  $Home;

```
  

#### การ import ไฟล์ css

- โดยปกติแล้วสามารถนำไฟล์ css ไว้ที่โฟลเดอร์ public และ link แบบปกติได้ แต่หากต้องการใช้ `import` ก็สามารถทำได้ดังนี้

```php

import('./src/home.css');

```

- จากตัวอย่างนั้นจะเห็นได้ว่ามีการใส่ `./` นำหน้า และมีการใส่นามสกุลไฟล์ (.css) ไว้

- เมื่อทำการ import แบบนี้ เนื้อหา css จะถูกนำไปเพิ่มยังหน้าเว็บ และไม่จำเป็นต้องนำไฟล์ css ไว้ที่โฟลเดอร์ public

- อย่าลืมใช้ `showStyles()` ตรงที่ๆ ต้องการให้ CSS แสดงด้วยละ

---
