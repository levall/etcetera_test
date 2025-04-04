
# REST API documentation

Документація REST API для тестового проекту Etcetera

## GET request
Запит для пошуку та фільтрації об'єктів нерухомості.
Повертає список усіх об'єктів нерухомості який відповідая запиту

### Endopoint:
```sh
[https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/edit-immovable](https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/get-immovable)
```
Коли запит без парметрів він повертає всі існуючы об'екти нерухомості

### GET параметри:

GET запит ПОВИНЕН мати наступні параметри:

```sh
parameter
```	
-build_name
-coordinates
-floors_number
-ecology
-build_type
-squart
-rooms_number
-bathroom
-porch
-post_id

Для пошуку інформації по id запису використовується post_id параметр.
Для пошуку по параметрам об'єкту нерухомості всі інші. 
	
```sh
value
```
Значення параметру який треба знайти. 

### Приклад сURL:

```sh
curl --location 'https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/get-immovable?parameter=post_id&value=22'
```

## POST request
За допомогую POST можливо додати новий об'єкт нерухомості.
Повертає результат виконнання запиту.

### Endopoint:
```sh
https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/add-new-immovable
```

### POST параметри:

ПОВИНЕН мати наступні параметри:

```sh
build_name
```
Ім'я будівлі. Тип - строка. Дозволяеться викорстання букв цифр та символів "-" , " ". 

```sh
coordinates
```
Координати будівлі. Тип - строка. Дозволяеться викорстання букв цифр та символів "-" , " ". 

```sh
ecology
```
Екологія. Тип - строка. Значення повиино бути цифрою від 1 до 5. 

```sh
build_type
```
Тип будівлі. Значення повинно бути одним з: "панель", "цегла", "піноблок"

```sh
floors_number
```
Кількість поверхів.  Значення повиино бути цифрою від 1 до 20. 

```sh
image
```
URL зображення будівлі. Значення повинно містити URL за яким можна скачати зображення

```sh
square
```
Ім'я будівлі. Можливо викорстання букв цифр та символів "-" , " ". 

```sh
rooms_number
```
Ім'я будівлі.  Значення повиино бути цифрою від 1 до 10.

```sh
square
```
Площа будівлі. Можливо викорстання букв цифр та символів "-" , " ". 

```sh
bathroom
```
Наявність санвузла.  Значення повинно бути одним з: "так", "ні" 

```sh
porch
```
Наявність балкона.  Значення повинно бути одним з: "так", "ні" 

```sh
room_image
```
URL зображення кімнати. Значення повинно містити URL за яким можна скачати зображення

### Приклад сURL:

```sh
curl --location 'https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/add-new-immovable' \
--header 'square: 1999' \
--header 'rooms_number: 8' \
--header 'porch: yes' \
--header 'bathroom: yes' \
--header 'room_image: https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgJera8hj7_0s4TKsiSp40tpaXlq6whMJWXc7beYfDJxqKLb-CRV-0oA9PNEjNMwB69OAjEgVzYp76e0s3AIpLFba7FHoSyh-DSx7QI71myWs2euOGyNSwtgGR9ka4s33-NCyoDhP4EKps/s1600/07_2.jpg' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--header 'Authorization: Bearer 00DPu0000012tnp!AQEAQErr2TOTNgPlLzU6oBcSbIaQA0yU29L8.ZlpldDflpiCXOUoltLHeh7zEl13AHfF0nY3ErlExLsafoe8QZmM3TuiyMIj' \
--data-urlencode 'build_name=Висока багатоповерхівка' \
--data-urlencode 'coordinates=9090 323' \
--data-urlencode 'floors_number=20' \
--data-urlencode 'build_type=цегла' \
--data-urlencode 'ecology=1' \
--data-urlencode 'image=https://33kanal.com/wp-content/uploads/2023/10/photo_2023-10-11_16-17-02-2.jpg' \
--data-urlencode 'rooms_number=10' \
--data-urlencode 'porch=так' \
--data-urlencode 'bathroom=так' \
--data-urlencode 'room_image=https://data.gov.ua/dataset/2bb82ded-0e92-48a8-abf4-12f49ae4f4ae/resource/edcc11b7-9372-4015-beeb-3a2bc2a4eb8d/download/avtokrazivskii_63.jpg' \
--data-urlencode 'square=1999м2'
```

## PUT request
Запит для оновлення об'єкту нерухомості

### Endopoint:
```sh
https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/edit-immovable
```

### Put параметри:

PUT запит ПОВИНЕН мати наступні параметри:

```sh
post_id
```
id поста параметри якого треба оновити

```sh
parameter
```	
-build_name
-coordinates
-floors_number
-ecology
-build_type
-squart
-rooms_number
-bathroom
-porch
	
```sh
value
```
Нове значення параметру

### Приклад сURL:

```sh
curl --location --request PUT 'https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/edit-immovable?parameter=build_name&new_value=%D0%9D%D0%BE%D0%B2%D0%B0%20%D0%BD%D0%B0%D0%B7%D0%B2%D0%B0%20%D0%B7%20%D1%80%D0%B5%D1%81%D1%82%20%D0%B0%D0%BF%D0%B8&post_id=22' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'parameter=coordinates' \
--data-urlencode 'new_value=999 333' \
--data-urlencode 'post_id=22'
```


## DELETE request
Запит для видалення об'єктів нерухомості.
Видаляє об'єкт нерухомості і всі звязані поля. Повертає результат видалення та інформацію по об'єкту який було видално.

### Endopoint:
```sh
https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/delete-immovable
```

### DELETE параметри:

DELETE запит ПОВИНЕН мати наступні параметри:

```sh
parameter
```
Повинен мати значення:
-post_id
	
```sh
value
```
ID об'якту який потрібно видалити


### Приклад сURL:

```sh
curl --location --request DELETE 'https://etcetera.zakarpat-maf.com.ua/wp-json/etcetera/v2/delete-immovable' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'parameter=post_id' \
--data-urlencode 'value=112'
```
