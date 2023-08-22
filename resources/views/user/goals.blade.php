@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Goals List</h5>
                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#createGoalModal">Create New Goal
                        </button>
                    </div>
                    <div class="card-body" id="user-goals">
                        <div class="card-deck" id="user-goal">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modal_create_goal')
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let user_id = {{ auth()->user()->id }};
        $.get('{{ route('api.goals.index') }}', {
            'user_id': user_id
        })
            .done(function (response) {
                if (response['success'] === true) {
                    if (response['data'].length === 0) {
                        $('#user-goals').append($('' + '<h2>No goals</h2>'));
                    }
                    let goals = response['data'];
                    goals.forEach(function (goal) {
                        let date = new Date(goal['created_at']).toLocaleDateString('ru-RU');
                        let route = window.location.href + '/' + goal['id'];
                        $('#user-goal').append($('' +
                            '<div class="card">' +
                            '<div class="card-body-' + goal["id"] + '">' +
                            '<a href="' + route + '"><h5 class="card-title">' + goal['name'] + '</h5></a>' +
                            '<p class="card-text">Goal message: ' + goal['message'] + '</p>' +
                            '</div>' +
                            '<div class="card-footer"><small class="text-muted">Created: ' + date + '</small></div>' +
                            '</div>'
                        ));
                    })
                }
            });
    }, false);
</script>
