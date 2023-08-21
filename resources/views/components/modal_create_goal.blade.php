<!-- Modal Goal-->
<div class="modal fade" id="createGoalModal" tabindex="-1" aria-labelledby="createGoalModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGoalModalLabel">New Goal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="goal-name">Goal name</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control required" id="goal-name"
                               aria-describedby="basic-addon3"
                               placeholder="Reach goal">
                    </div>
                    <label for="goal-message">Message:</label>
                    <input type="text" class="deal form-control mb-1" id="goal-message"
                           aria-describedby="basic-addon3"
                           placeholder="Do something">
                    <label for="goal-notification-date">Choose Notification Date:</label>
                    <input type="date" class="deal form-control mb-1" id="goal-notification-date"
                           aria-describedby="basic-addon3">
                    <label for="goal-notification-time">Choose Notification Time:</label>
                    <input type="time" class="deal form-control mb-1" id="goal-notification-time"
                           aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-goal">Create Goal</button>
            </div>
        </div>
    </div>
</div>

<script type="module">
    $('.save-goal').on('click', function () {
        $('.alert').remove();
        let goalName = $('#goal-name').val();
        let goalMessage = $('#goal-message').val();
        let goalNotificationDate = $('#goal-notification-date').val();
        let goalNotificationTime = $('#goal-notification-time').val();
        let goalNotification = goalNotificationDate + ' ' + goalNotificationTime
        $.post('{{ route('api.user.goals.store', auth()->user()->id) }}',
            {
                'name': goalName,
                'message': goalMessage,
                'notify_at': goalNotification,
            })
            .done(function () {
                window.location.reload();
            })
            .fail(function (response) {
                let data = response['responseJSON'];
                $('.modal-body').prepend($('' +
                    '<div class="alert alert-danger">' +
                    '<h5>' + data['message'] + '</h5>' +
                    '<ul class="errors-list">'));
                data['data'].forEach(function (error) {
                    $('.errors-list').prepend($('' +
                    '<li>' + error + '</li>' ));
                });
                $('.modal-body').prepend($('' +
                    '</ul>' +
                    '</div>'
                ));
            });
    });
</script>
