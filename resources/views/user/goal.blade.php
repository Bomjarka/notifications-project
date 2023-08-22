@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <h5>Goal: {{ $goal->name }}</h5>
                        </div>
                        <div>
                            <button type="button" class="btn btn-info remove-tags-from-list-item"
                                    id="edit-goal">Edit goal
                            </button>
                            <button type="button" class="btn btn-danger remove-tags-from-list-item"
                                    id="remove-goal">Remove goal
                            </button>
                        </div>
                    </div>
                    <div class="card-body" id="user-goals">
                        <div class="card-deck" id="user-goal">
                            <div class="card">
                                <div class="card-body" id="goal-info">
                                    <p class="card-text">Goal message: {{ $goal->message }}</p>
                                    @if($goal->notify_at)
                                        <p class="card-text">Goal notify at: {{ $goal->notify_at }}</p>
                                    @endif
                                </div>
                                <div class="card-body" id="goal-edit-group" hidden>
                                    <label>Put new name:
                                        <input id="goal-name" type="text" placeholder="{{ $goal->name }}"
                                               value="{{ $goal->name }}" name="name"
                                               required>
                                    </label>
                                    <label>Put new message:
                                        <input id="goal-message" type="text" placeholder="{{ $goal->message }}"
                                               value="{{ $goal->message }}"
                                               name="message" required>
                                    </label>
                                    <br>
                                    @if($goal->notify_at)
                                        <p class="card-text">Current notification: {{ $goal->notify_at }}</p>
                                    @endif
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="pick-date">
                                        <label class="form-check-label" for="pick-date">
                                            Change notification date
                                        </label>
                                    </div>
                                    <label for="goal-notification-date">Choose Notification Date:</label>
                                    <input id="goal-date" type="date" class="deal form-control mb-1"
                                           id="goal-notification-date"
                                           aria-describedby="basic-addon3" disabled>
                                    <label for="goal-notification-time">Choose Notification Time:</label>
                                    <input id="goal-time" type="time" class="deal form-control mb-1"
                                           id="goal-notification-time"
                                           aria-describedby="basic-addon3" disabled>
                                    <button type="button" class="btn btn-warning update-goal"
                                            id="cancel-update-goal">Cancel
                                    </button>
                                    <button type="button" class="btn btn-success update-goal"
                                            id="update-goal">Update goal
                                    </button>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text">Goal created: {{ $goal->created_at }}</p>
                                </div>
                            </div>
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
        $('#edit-goal').on('click', function () {
            $('#goal-info').hide();
            $('#goal-edit-group').removeAttr('hidden');
        });
        $('#cancel-update-goal').on('click', function () {
            $('#goal-info').show();
            $('#goal-edit-group').attr('hidden', true);
        })
        $('#pick-date').on('change', function () {
            if (this.checked === true) {
                $('#goal-date').removeAttr('disabled');
                $('#goal-time').removeAttr('disabled');
            } else {
                $('#goal-date').attr('disabled', true);
                $('#goal-time').attr('disabled', true);
            }
        });
        $('#update-goal').on('click', function () {
            $('.alert').remove();
            let name = $('#goal-name').val();
            let message = $('#goal-message').val();
            let updateNotificationDate = $('#pick-date').prop('checked');
            let date = $('#goal-date').val();
            let time = $('#goal-time').val();
            let goalNotification = date + ' ' + time;
            $.ajax({
                url: '{{ route('api.goal.update', $goal->id) }}',
                type: 'PUT',
                dataType: 'json',
                data: {
                    'name': name,
                    'message': message,
                    'notify_at': goalNotification,
                    'updateNotificationDate': updateNotificationDate
                },
                success: function () {
                    window.location.reload();
                },
                error: function (response) {
                    let data = response['responseJSON'];
                    $('#goal-edit-group').prepend($('' +
                        '<div class="alert alert-danger">' +
                        '<h5>' + data['message'] + '</h5>' +
                        '<ul class="errors-list">'));
                    data['data'].forEach(function (error) {
                        $('.errors-list').prepend($('' +
                            '<li>' + error + '</li>'));
                    });
                    $('.modal-body').prepend($('' +
                        '</ul>' +
                        '</div>'
                    ));
                }
            });
        });
        $('#remove-goal').on('click', function () {
            if (confirm('Are you sure you want to delete this goal?')) {
                $.ajax({
                    url: '{{ route('api.goal.delete', $goal->id) }}',
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (data) {
                    },
                    error: function (data) {
                        console.log('Error in Operation');
                    }
                });
            }
        });
    }, false);
</script>
