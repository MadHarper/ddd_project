Реализовать сервис для работы с записями о работниках компании.
Сервис должен предоставлять следующие возможности:
- получение списка работников
- получение работника
- создание работника
- удаление работника
- отправка работника в архив
- восстановление работника из архива

Работник имеет:
- идентификатор
- имя
- фамилию
- отчество
- адрес, состоящий из страны, региона, города, улицы и дома
- коллекцию телефонов, где каждый элемент состоит из кода страны, кода города/оператора и номера
- коллекцию статусов, где каждый элемент состоит из наименования статуса и даты смены статуса.последний из добавленных статусов является актуальным, возможные варианта статуса – активен или архивный- дату создания- дату измененияБизнес-требования: - работник должен иметь хотя бы один номер телефона- работник должен иметь хотя бы имя и фамилию- адрес работника должен иметь хотя бы страну и город
- операции над работником должны порождать события. Событие должно описывать операцию, изменения и время. Отправка событий через условный диспетчер событий.Условная многоуровневая архитектура системы:- слой представления (пользовательский интерфейс/контроллеры)- слой приложения (сервисы приложения)- слой домена (бизнес-логика)- слой инфраструктуры (хранение данных, логирование, взаимодействие с внешними системами, реализация конкретных сервисов приложения/домена)Требования к коду:- слабая связанность, слой приложения зависит лишь от слоя домена, слой домена не зависит ни от чего, используйте инверсию зависимостей- ошибки валидации должны генерировать исключения, сущности не должны находиться в не валидном состоянии- запрещается использование сторонних библиотек/фреймворка, только старый добрый PHP- для работы с абстрактным хранилищем используйтесь шаблон репозитория- обратите внимание, что реализовывать клиентский код (контроллеры вызывающие методы сервиса) и инфраструктуру (работу с бд и прочее) не требуется, в конечном счёте у вас должны быть объекты/сервисы/компоненты/классы в слоях приложения и домена