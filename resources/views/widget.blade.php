<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>feedback</title>
    <style>
        body {
            margin: 0;
            padding: 10px;
        }
        form {
            margin: 0;
        }
        .form-row {
            margin-bottom: 8px;
        }
        input,
        textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 6px;
        }
        button {
            padding: 6px 10px;
            cursor: pointer;
        }
        .msg {
            margin-top: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<form id="feedback-form">
    <div class="form-row">
        <input type="text" name="name" placeholder="name">
    </div>
    <div class="form-row">
        <input type="email" name="email" placeholder="email">
    </div>
    <div class="form-row">
        <input type="text" name="phone" placeholder="phone">
    </div>
    <div class="form-row">
        <input type="text" name="topic" placeholder="topic">
    </div>
    <div class="form-row">
        <textarea name="text" rows="3" placeholder="text"></textarea>
    </div>
    <button type="submit">Send</button>
</form>
<div class="msg" id="feedback-msg"></div>

<script>
    const form = document.getElementById('feedback-form');
    const msg = document.getElementById('feedback-msg');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        msg.textContent = '';
        const response = await fetch("{{ route('api.widget.store') }}", {
            method: 'POST',
            headers: {
                'Accept': 'application/json'
            },
            body: new FormData(form)
        });

        if (response.ok) {
            const data = await response.json();
            msg.textContent = data.message || 'успешно отправлено';
            form.reset();
            return;
        }
        if (response.status === 422) {
            const errorData = await response.json();
            if (errorData.errors) {
                let html = '<ul>';
                Object.values(errorData.errors).forEach(messages => {
                    messages.forEach(message => {
                        html += `<li>${message}</li>`;
                    });
                });
                html += '</ul>';
                msg.innerHTML = html;
                return;
            }
        }
        msg.innerHTML = '<p>Произошла ошибка отправки</p>';
    });
</script>
</body>
</html>
