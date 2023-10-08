<form method="post" action="/email/send">
    @csrf
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="form-group">
        <label for="recipient">Recipient Email:</label>
        @include('email.partials.input', ['type' => 'email', 'name' => 'recepient', 'id' => 'recipient'])
    </div>

    <div class="form-group">
        <label for="subject">Subject:</label>
        @include('email.partials.input', ['type' => 'text', 'name' => 'subject', 'id' => 'subject'])
    </div>

    <div class="form-group">
        <label for="message">Message:</label>
        <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send Email</button>
</form>
