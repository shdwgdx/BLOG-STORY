@extends('layouts.admin')
@section('content-header')
    <h1 class="m-0 text-dark content-header">Users</h1>
@endsection
@section('content')
    <div class="card__item">
        <div class="container-fluid p-0">
            <table class="table" id="table-id">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Route</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('route', ['route' => $user->route->id]) }}">{{ $user->route->title }}</a>
                            </td>
                            <td>{{ date('d.m.Y H:i', strtotime($user->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--		Start Pagination -->
            <div class='pagination-container'>
                <div class="table-rows">Rows per page:
                </div>
                <div class="form-group table-select-group"> <!--		Show Numbers Of Rows 		-->
                    <select class="form-control table-select" name="state" id="maxRows">
                        <option value="all">All</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                </div>
                <div class="pagination-selected">6-10 of 11</div>
                <nav>
                    <ul class="pagination">
                        <li data-page="prev">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" class="prev-button" height="20"
                                    viewBox="0 0 20 20" fill="none">
                                    <path d="M12.5 15L7.5 10L12.5 5" stroke="#A7B1BC" class="table-arrow-left"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg> <span class="sr-only">(current)
                                </span></span>
                        </li>
                        <!--	Here the JS Function Will Add the Rows -->
                        <li data-page="next" id="prev">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                                    fill="none">
                                    <path d="M7.5 15L12.5 10L7.5 5" class="table-arrow-right" stroke="#212B36"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg><span class="sr-only">(current)</span></span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> <!-- 		End of Container -->
    </div>




    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script>
        // Получаем элементы таблицы и пагинации
        const table = document.getElementById("table-id");
        const maxRowsSelect = document.getElementById("maxRows");
        const pagination = document.querySelector(".pagination");

        // Устанавливаем количество строк на странице по умолчанию
        let maxRows = 10;
        let currentPage = 1; // Инициализируем текущую страницу

        // Установите значение "15" для элемента maxRowsSelect
        maxRowsSelect.value = "10";

        // Функция для обновления пагинации и отображаемых элементов
        const updatePagination = () => {
            // Получаем все строки таблицы, кроме заголовка
            const rows = table.querySelectorAll("tbody tr");

            // Вычисляем общее количество страниц
            const totalPages = Math.ceil(rows.length / maxRows);
            if (maxRowsSelect.value === "all") {

                // Показывать все строки
                rows.forEach((row) => {
                    row.style.display = "";
                });
                const currentPageInfo = document.querySelector(".pagination-selected");
                currentPageInfo.textContent = "1-" + rows.length + " of " + rows.length;
                pagination.style.display = "none"; // Скрываем пагинацию
            } else {
                // Нормальное отображение с пагинацией
                pagination.style.display = ""; // Показываем пагинацию

                // Очищаем текущую пагинацию
                pagination.innerHTML = "";

                // Создаем кнопки предыдущей и следующей страницы
                const prevButton = document.createElement("li");
                prevButton.setAttribute("data-page", "prev");
                prevButton.innerHTML =
                    '<span><svg xmlns="http://www.w3.org/2000/svg" class="prev-button" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M12.5 15L7.5 10L12.5 5" stroke="#212B36" class="table-arrow-left" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg><span class="sr-only">(current)</span></span>';

                const nextButton = document.createElement("li");
                nextButton.setAttribute("data-page", "next");
                nextButton.innerHTML =
                    '<span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7.5 15L12.5 10L7.5 5" class="table-arrow-right" stroke="#212B36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg><span class="sr-only">(current)</span></span>';

                // Добавляем кнопки в пагинацию
                pagination.appendChild(prevButton);
                pagination.appendChild(nextButton);

                // Обновляем отображаемые элементы
                const start = (currentPage - 1) * maxRows;
                let end = start + maxRows - 1;
                if (end >= rows.length) {
                    end = rows.length - 1;
                }

                rows.forEach((row, index) => {
                    if (index >= start && index <= end) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
                console.log(currentPage);
                console.log(totalPages);
                // Проверяем, является ли текущая страница первой или последней
                if (currentPage === 1) {
                    prevButton.innerHTML =
                        '<span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M12.5 15L7.5 10L12.5 5" stroke="#A7B1BC" class="table-arrow-left" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg><span class="sr-only">(current)</span></span>';
                } else if (currentPage === totalPages) {
                    nextButton.innerHTML =
                        '<span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7.5 15L12.5 10L7.5 5" class="table-arrow-right" stroke="#A7B1BC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg><span class="sr-only">(current)</span></span>';
                }

                // Обработчик события при нажатии кнопки предыдущей или следующей страницы
                prevButton.addEventListener("click", () => {
                    if (currentPage > 1) {
                        currentPage--;
                        updatePagination();
                    }
                });

                nextButton.addEventListener("click", () => {
                    if (currentPage < totalPages) {
                        currentPage++;
                        updatePagination();
                    }
                });

                // Обновляем информацию о текущей странице
                const currentPageInfo = document.querySelector(".pagination-selected");
                currentPageInfo.textContent = `${start + 1}-${end + 1} of ${rows.length}`;
            }
        };

        // Обработчик события при изменении количества строк на странице
        maxRowsSelect.addEventListener("change", () => {
            maxRows = parseInt(maxRowsSelect.value);
            currentPage = 1; // Сбрасываем текущую страницу
            updatePagination();
        });

        // Инициализируем пагинацию
        updatePagination();
    </script>
@endsection
