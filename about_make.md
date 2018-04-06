1)Всё построено на GET, POST запросах. Удаление и редактирование идёт через те же запросы, не по rest, так же роуты не по rest
2)Используются куки для аутентификации, а не токен авторизации
3)Обозначение имён методов не всегда корректные
4)делается лишний запрос в базу при пустом id
    $artId = !empty($request->get('id')) ? $request->get('id') : 0;
    $art = $artRepo->byId($artId);
5) При проверке прав нужно возвращать json код, а не страницу, то есть где-то json возвращается, а где-то html
6)Валидация не вынесена в формы или промежуточный метод, всё делается в контроллере
7)Зачем везде ставить по умолчанию 0, если нет
        $newCatId = !empty($request->request->get('catId')) ? $request->request->get('catId') : 0;
        $newName = $request->request->get('name') ? $request->request->get('name') : 0;
        $newDescr = $request->request->get('description') ? $request->request->get('description') : 0;
8)путаются коды ошибок, иногда вместо 404, нужно 400
