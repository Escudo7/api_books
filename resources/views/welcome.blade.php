<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Books API Project</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
            .hide {
                display: none;
            }
            .hide-sibbling {
                cursor: pointer;
            }
            .hide-sibbling:hover {
                color: #148c88;
            }
            .selected {
                color: #148c88;
            }
        </style>

        <script>
            $(document).ready(function () {
                $('.hide-sibbling').click(function () {
                    $(this).next().is(":hidden") ? $(this).addClass('selected') : $(this).removeClass('selected');
                    $(this).next().toggle(700);
                })
            });

        </script>
    </head>
    <body>
    <div class="jumbotron">
        <h1 class="display-4">Books API</h1>
        <p class="lead">Учебный проект по REST API для уплавнения коллекцией книг, авторов, жанров</p>
        <hr class="my-4">
        <p class="font-weight-bold h3">Документация по предоставляемым методам API:</p>
        <div class="my-3">
            <p class="h4">Управление коллекцией книг</p>
            <div class="ml-5">
                <p class="h4 hide-sibbling">Получение списка книг</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: GET /api/books/</p>
                    <p>Параметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>limit</td>
                            <td>Необязательный</td>
                            <td>Ограничивает количество возвращаемых единиц данных. При отстуствии параметра возвращается вся коллекция целиком</td>
                        </tr>
                        <tr>
                            <td>offset</td>
                            <td>Необязательный</td>
                            <td>Позволяет пропустить указанное количество единиц данных перед выводом результата запроса. По умолчанию равен 0</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
[
    {
        "id": 2,
        "name": "Война и мир"
        "authors": [
            {
                "id": 1,
                "first_name": "Лев",
                "middle_name": "Николаевич",
                "last_name": "Толстой"
            }
        ],
        "genres": [
            {
                "id": 1,
                "name": "Классика"
            },
            {
                "id": 2,
                "name": "История"
            }
        ],
        "year_publication": 1868
    }
]
                            </pre>
                </div>
                <p class="h4 hide-sibbling">Создание новой книги</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: POST /api/books/</p>
                    <p>Парметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>name</td>
                            <td>Обязательный</td>
                            <td>Название книги</td>
                        </tr>
                        <tr>
                            <td>authors_id</td>
                            <td>Обязательный</td>
                            <td>Список ID авторов. Передается в массиве</td>
                        </tr>
                        <tr>
                            <td>genres_id</td>
                            <td>Обязательный</td>
                            <td>Список ID жанров. Передается в массиве</td>
                        </tr>
                        <tr>
                            <td>year_publication</td>
                            <td>Обязательный</td>
                            <td>Год публикации. Не может быть больше текущего</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
{
    "id": 19,
    "name": "Машина времени"
    "authors": [
        {
            "id": 7,
            "first_name": "Герберт",
            "middle_name": "",
            "last_name": "Уэллс"
        }
    ],
    "genres": [
        {
            "id": 3,
            "name": "Фантастика"
        },
    ],
    "year_publication": 1895
}
                </pre>
                </div>
                <p class="h4 hide-sibbling">Изменение книги</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: PATCH /api/books/{book_id}</p>
                    <p>Парметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>name</td>
                            <td>Необязательный</td>
                            <td>Новое название книги</td>
                        </tr>
                        <tr>
                            <td>authors_id</td>
                            <td>Необязательный</td>
                            <td>Новый список ID авторов. Передается в массиве</td>
                        </tr>
                        <tr>
                            <td>genres_id</td>
                            <td>Необязательный</td>
                            <td>Новый список ID жанров. Передается в массиве</td>
                        </tr>
                        <tr>
                            <td>year_publication</td>
                            <td>Необязательный</td>
                            <td>Новый год публикации. Не может быть больше текущего</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
{
    "id": 19,
    "name": "Машина времени"
    "authors": [
        {
            "id": 7,
            "first_name": "Герберт",
            "middle_name": "",
            "last_name": "Уэллс"
        }
    ],
    "genres": [
        {
            "id": 3,
            "name": "Фантастика"
        },
        {
            "id": 4,
            "name": "Приключения"
        },
    ],
    "year_publication": 1895
}
                    </pre>
                </div>
                <p class="h4 hide-sibbling">Удаление книги</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: DELETE /api/books/{book_id}</p>
                    <p>Пример запроса: </p>
                </div>
            </div>
        </div>
        <div class="my-3">
            <p class="h4">Управление коллекцией авторов</p>
            <div class="ml-5">
                <p class="h4 hide-sibbling">Получение списка авторов</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: GET /api/authors/</p>
                    <p>Параметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>limit</td>
                            <td>Необязательный</td>
                            <td>Ограничивает количество возвращаемых единиц данных. При отстуствии параметра возвращается вся коллекция целиком</td>
                        </tr>
                        <tr>
                            <td>offset</td>
                            <td>Необязательный</td>
                            <td>Позволяет пропустить указанное количество единиц данных перед выводом результата запроса. По умолчанию равен 0</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
[
    {
        "id": 1,
        "first_name": "Лев",
        "middle_name": "Николаевич",
        "last_name": "Толстой"
    },
    {
        "id: 2,
        "first_name": "Роберт",
        "middle_name": "",
        "last_name": "Хайнлайн"
    }
]
                            </pre>
                </div>
                <p class="h4 hide-sibbling">Создание нового автора</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: POST /api/authors/</p>
                    <p>Парметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>first_name</td>
                            <td>Обязательный</td>
                            <td>Имя автора</td>
                        </tr>
                        <tr>
                            <td>middle_name</td>
                            <td>Необязательный</td>
                            <td>Отчество автора</td>
                        </tr>
                        <tr>
                            <td>last_name</td>
                            <td>Обязательный</td>
                            <td>Фамилия автора</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
{
    "id": 12,
    "first_name": "Сергей",
    "middle_name": "Александрович",
    "last_name": "Есенин"
}
                    </pre>
                </div>
                <p class="h4 hide-sibbling">Изменение автора</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: PATCH /api/authors/{author_id}</p>
                    <p>Парметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>first_name</td>
                            <td>Необязательный</td>
                            <td>Имя автора</td>
                        </tr>
                        <tr>
                            <td>middle_name</td>
                            <td>Необязательный</td>
                            <td>Отчество автора</td>
                        </tr>
                        <tr>
                            <td>last_name</td>
                            <td>Необязательный</td>
                            <td>Фамилия автора</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
{
    "id": 10,
    "first_name": "Дэшил",
    "middle_name": "",
    "last_name": "Хэммет"
}
                    </pre>
                </div>
                <p class="h4 hide-sibbling">Удаление автора</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: DELETE /api/authors/{author_id}</p>
                    <p>Пример запроса: </p>
                </div>
            </div>
        </div>
        <div class="my-3">
            <p class="h4">Управление коллекцией жанров</p>
            <div class="ml-5">
                <p class="h4 hide-sibbling">Получение списка жанров</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: GET /api/genres/</p>
                    <p>Параметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>limit</td>
                            <td>Необязательный</td>
                            <td>Ограничивает количество возвращаемых единиц данных. При отстуствии параметра возвращается вся коллекция целиком</td>
                        </tr>
                        <tr>
                            <td>offset</td>
                            <td>Необязательный</td>
                            <td>Позволяет пропустить указанное количество единиц данных перед выводом результата запроса. По умолчанию равен 0</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
[
    {
        "id": 1,
        "name": "Классика"
    },
    {
        "id": 2,
        "name": "История"
    }
]
                    </pre>
                </div>
                <p class="h4 hide-sibbling">Создание нового жанра</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: POST /api/genres/</p>
                    <p>Парметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>name</td>
                            <td>Обязательный</td>
                            <td>Название жанра</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
{
    "id": 5,
    "name": "Детектив"
}
                    </pre>
                </div>
                <p class="h4 hide-sibbling">Изменение жанра</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: PATCH /api/genres/{genre_id}</p>
                    <p>Парметры запроса:</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Название</th>
                            <th>Обязательность</th>
                            <th>Описание</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>name</td>
                            <td>Необязательный</td>
                            <td>Новое название жанра</td>
                        </tr>
                    </table>
                    <p>Пример запроса: </p>
                    <p>Пример ответа:</p>
                    <pre class="pre-scrollable">
{
    "id": 4,
    "name": "Поэзия"
}
                    </pre>
                </div>
                <p class="h4 hide-sibbling">Удаление жанра</p>
                <div class="hide pl-3">
                    <p class="h5">Маршрут: DELETE /api/ganres/{ganre_id}</p>
                    <p>Пример запроса: </p>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
