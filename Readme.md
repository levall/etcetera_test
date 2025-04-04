
# REST API documentation

Документація REST API для тестового проекту Etcetera

## GET request



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
	-post_id
	
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

[!IMPORTANT]
Параметри повинні додаватись до тіла запиту

	
