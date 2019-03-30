Для создания БД и таблиц нужно запустить

```
vendor/bin/phinx migrate
```

Пользователи в талицу users добавляются следующей командой **1 раз**

```
vendor/bin/phinx seed:run -s UsersSeeder
```

Проект разрабатывался и тестировался из условий расположения http://host/prefix/

prefix для php части настраивается в файле

```
db/config/constants.php
```

prefix для js части настраивается в файлах

```
js_modules/vue_components/ChatRoom.vue line: 42
```

Webpack - ** обязательно **

```
webpack.config.js line: 4 - это публичный путь JS файлов при сборке
```
