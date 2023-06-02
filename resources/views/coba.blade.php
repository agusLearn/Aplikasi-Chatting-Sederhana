<!DOCTYPE html>
<head>
    <title>Pusher Test</title>
</head>
<body>
<h1>Pusher Test</h1>
<p>
    Publish an event to channel <code>my-channel</code>
    with event name <code>my-event</code>; it will appear below:
</p>
<div>
    <h1>Welcome to pusher frontend</h1>
</div>

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('17034a2e9c291053cb4e', {
        cluster: 'ap1',
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data)
        alert(JSON.stringify(data))
        app.messages.push(JSON.stringify(data)); //Data assignment
    });
</script>
</body>