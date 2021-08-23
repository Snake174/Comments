<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Comments</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="content-language" content="ru" />
        <meta name="format-detection" content="telephone=no" />
        <meta http-equiv="x-rim-auto-match" content="none">
        <meta name="viewport" content="initial-scale=1, width=device-width" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="//cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
        <style>
            html, body {
                -webkit-font-smoothing: antialiased;
            }
            html {
                position: relative;
                min-height: 100%;
            }
            p {
                padding: 5px 0;
            }
            .card {
                margin-bottom: 10px;
            }
            .container-top {
                padding: 50px 10px 30px;
            }
            .container-main {
                padding: 0 10px 30px;
            }
            .container-bottom {
                padding: 0 10px 100px;
            }
            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 60px;
                line-height: 60px;
            }
        </style>
    </head>
    <body>
        <nav class="nav justify-content-end ml-auto navbar-dark bg-dark" style="padding: 10px;">
            @guest
                <form method="post" action="{{ route('login') }}" class="row row-cols-lg-auto g-3 align-items-center d-flex" id="login_form">
                    @csrf
                    <div class="col-12">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Username" />
                    </div>
                    <div class="col-12">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-secondary">Войти</button>
                    </div>
                </form>
            @else
                <a href="{{ route('logout') }}" class="btn btn-secondary">Выйти</a>
            @endguest
        </nav>

        <div class="container container-fluid container-top">
            <div class="row" id="commentSlider">
                @php  $ind = 0; @endphp
                @foreach ($sliderComments as $comment)
                    <div class="col" data-id="{{ $ind }}" hidden>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $comment->author }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at }}</h6>
                                <p class="card-text">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    </div>
                    @php ++$ind; @endphp
                @endforeach
            </div>

            @if (count($sliderComments) > 0)
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div class="btn-group d-grid mx-auto d-flex p-2" role="group">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnSliderPrev"><</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="btnSliderNext">></button>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="container container-fluid container-main">
            <h1 class="text-center">Тестовое задание на должность "Программист PHP"</h1>

            <p>
                <h5>Общее</h5>
                Можно (но не обязательно) использовать любой фреймворк, как для бэка так и для фронта.
            </p>

            <p>
                <h5>Суть задачи</h5>
                Реализовать страницу с комментариями к произвольному статичному тексту.
            </p>

            <p>
                <h5>Задачи</h5>

                <ul>
                    <li>Реализовать добавление комментария, оно должно происходить без перезагрузки страницы.</li>
                    <li>Изначально показывать 3 комментария, остальные должны подгружаться (3 за один раз) по нажатию на кнопку "Показать ещё".</li>
                    <li>Страница должна быть защищена авторизацией. Неавторизованному пользователю доступен только просмотр. Логин и пароль должны храниться в БД.</li>
                    <li>Реализовать фильтрацию комментариев по автору. Поле фильтра по автору должно быть текстовым. В процессе ввода (начиная с 3х символов) должны предлагаться варианты авторов. Автор = логин.</li>
                    <li>Реализовать слайдер с 5 случайными комментариями. Единовременно должны отображаться только 2 комментария остальные доступны при пролистывании. Слайдер зациклить (после последнего снова отображается первый) Слайдер расположить выше статичного текста.</li>
                </ul>
            </p>
        </div>

        <div class="container container-fluid container-bottom">
            <h3>Комментарии</h3>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Автор</span>
                <input type="text" id="filter_author" class="form-control" aria-describedby="basic-addon1" />
            </div>

            <div id="comments">
                @foreach ($comments as $comment)
                    <div class="card" data-id="{{ $comment->author }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $comment->author }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at }}</h6>
                            <p class="card-text">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-grid gap-2 col-6 mx-auto" style="padding: 20px 0;">
                <button class="btn btn-secondary" id="show_more" count_show="3" count_add="3">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                    Показать ещё
                </button>
            </div>

            @can('create', App\Models\Comment::class)
                <div class="card bg-dark" style="padding: 20px;">
                    <form id="comments_form">
                        <div class="mb-3">
                            <label for="user_comment" class="form-label text-muted">Оставить комментарий [<b>{{ auth()->user()->name }}</b>]</label>
                            <textarea class="form-control" id="user_comment" rows="5"></textarea>
                        </div>
                        <button class="btn btn-secondary" type="submit">Отправить</button>
                    </form>
                </div>
            @endcan
        </div>

        <footer class="footer bg-dark">
            <div class="container">
                <span class="text-muted float-end">&copy; 2021, Serebryannikov Evgeniy</span>
            </div>
        </footer>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script>
            (function($) {
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    const $comments = $('#comments');
                    const $commentSlider = $('#commentSlider');
                    var sliderCommentsShow = [0, 1];

                    var showSlides = function () {
                        $('#commentSlider > div.col').each(function () {
                            const $this = $(this);
                            const dataID = parseInt($this.attr('data-id'));

                            if (sliderCommentsShow.includes(dataID))
                            {
                                $this.removeAttr('hidden');

                                const lastFirst = JSON.stringify(sliderCommentsShow) === JSON.stringify([4, 0]);
                                const firstLast = JSON.stringify(sliderCommentsShow) === JSON.stringify([0, 4]);

                                if (lastFirst && dataID == 4)
                                    $this.addClass('order-first');
                                else if (lastFirst && dataID == 0)
                                    $this.addClass('order-last');
                                else if (firstLast && dataID == 4)
                                    $this.addClass('order-last');
                                else if (firstLast && dataID == 0)
                                    $this.addClass('order-first');
                                else
                                {
                                    $this.removeClass('order-first');
                                    $this.removeClass('order-last');
                                }
                            }
                            else
                                $this.attr('hidden', '');
                        });
                    }

                    showSlides();

                    // Показать ещё
                    $('#show_more').click(function () {
                        const $this = $(this);
                        const $loading = $this.children('span');
                        const countShow = parseInt($this.attr('count_show'));
                        const countAdd = parseInt($this.attr('count_add'));
                        $loading.removeAttr('hidden');

                        $.ajax({
                            url: '{{ route("showMore") }}',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                'count_show': countShow,
                                'count_add': countAdd
                            },
                            success: function (data) {                           
                                if (data.success === 'ok')
                                {
                                    $this.attr('count_show', (countShow + 3));
                                    $comments.append(data.data);
                                }

                                $loading.attr('hidden', '');
                            },
                            error: function () {
                                $loading.attr('hidden', '');
                            }
                        });
                    });

                    // Отправка комментария
                    $('#comments_form').submit(function (e) {
                        e.preventDefault();

                        const $userComment = $('#user_comment');
                        const commentText = $userComment.val().trim();

                        if (commentText.length == 0)
                            return;
                        
                        $.ajax({
                            url: '{{ route("addComment") }}',
                            method: 'post',
                            dataType: 'json',
                            data: {
                                'comment': commentText
                            },
                            success: function (data) {                           
                                if (data.success === 'ok')
                                {
                                    $comments.append(data.data);
                                    $userComment.val('');
                                }
                            },
                            error: function () {
                            }
                        });
                    });

                    // Слайдер
                    $('#btnSliderPrev').click(function () {
                        var ind1 = sliderCommentsShow[0];
                        var ind2 = sliderCommentsShow[1];
                        ind2 -= 2;

                        if (ind2 < 0)
                            ind2 += 5;

                        sliderCommentsShow[0] = ind2;
                        sliderCommentsShow[1] = ind1;

                        showSlides();
                    });

                    $('#btnSliderNext').click(function () {
                        var ind1 = sliderCommentsShow[0];
                        var ind2 = sliderCommentsShow[1];
                        ind1 += 2;

                        if (ind1 > 4)
                            ind1 -= 5;

                        sliderCommentsShow[0] = ind2;
                        sliderCommentsShow[1] = ind1;

                        showSlides();
                    });

                    // Фильтр автора
                    $('#filter_author').keyup(function () {
                        const authorName = $(this).val();

                        if (authorName.length < 3)
                        {
                            $('#comments > div.card').each(function () {
                                $(this).removeAttr('hidden');
                            });

                            return;
                        }

                        $('#comments > div.card').each(function () {
                            $(this).attr('hidden', '');
                        });

                        $(`#comments > div.card[data-id*=${authorName}]`).removeAttr('hidden');
                    });
                });
            })(jQuery);
        </script>
    </body>
</html>
