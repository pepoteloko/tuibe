@extends('layout.basic')

@section('page_title', $title)

@section('content')
    <div class="title m-b-md">
        Laravel
    </div>

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="j-search">
                        <div class="form-row">
                            <div class="col-3">
                                <h4 class="card-title">Search a flight</h4>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="from">from
                                        Round Trip
                                    </label>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="from">from
                                        One Way
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="from">from
                                        <select name="from" class="form-control">
                                            <option value="AGP">Málaga</option>
                                            <option value="BCN">Barcelona</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="to">from
                                        <select name="to" class="form-control">
                                            <option value="AGP">Málaga</option>
                                            <option value="BCN">Barcelona</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="departure">departure
                                        <input type="date" name="departure" class="form-control">
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>
                                        return
                                        <input type="date" name="return" class="form-control">
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="adults">adults
                                        <select name="adults" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="children">children
                                        <select name="children" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="babies">babies
                                        <select name="babies" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <label>
                                    &nbsp;
                                    <a class="btn btn-success">Enviar</a>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('script')
    <script>
        $(function () {
            $('.j-search').on('change', 'select[name="from"]', function (e) {
                $.ajax({
                    dataType: 'json',
                    url: "/ajax",
                    data: {
                        action: 'from',
                        airport: $(this).val()
                    },
                    success: function (result) {
                        alert(result)
                    }
                });
            }).on('click', 'a', function () {
                alert('hola');
            })
        });
    </script>
@endpush
