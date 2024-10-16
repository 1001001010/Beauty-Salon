**Установка**
- Установить PHP <a>https://www.php.net/downloads</a>
- Установить Nodejs <a>https://nodejs.org/en/download</a> **Не меньше 19 версии**
- Установить Composer <a>https://getcomposer.org/</a>
- Клонировать репозиторий `git clone <link>`
- Скачать модули node `npm install`
- Установить composer `Composer i`
---
**Запуск**
- Создать файл конфигурации с примера `Copy .env.example .env` <br>
- Отредактировать файл конфигурации (`.env`) <br>
![image](https://github.com/user-attachments/assets/3de0c670-5f9c-4c5b-a5a7-2c807541b661)

![image](https://github.com/user-attachments/assets/883072c4-abf2-488c-a68e-526e89c7b1a4)


- Создать ключ приложения `php artisan key:generate`
- Мигрировать таблицы `php artisan migrate`
- Запустить приложения `npm run dev` и `php artisan serve`
---
Доп. комманды: 
- Создание админа `php artisan db:seed --class=AdminSeeder` (`admin@google.com`:`123123123`)
--- 
Используемый стек: 
* Laravel
* Tailwind
