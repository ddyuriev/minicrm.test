@extends('layouts.admin')

@section('content')
    <div class="container py-4">

        <div class="mb-4">
            <h4>Заявка #{{ $ticket->id }}</h4>

            <small class="text-muted">{{ $ticket->created_at->format('d.m.Y H:i') }}</small>
        </div>


        <div class="card mb-3">
            <div class="card-body">
                <form action="{{ route('tickets.update-status', $ticket) }}" method="POST" class="row g-2">
                    @csrf @method('PATCH')
                    <div class="col-auto">
                        <select name="status" class="form-select">
                            @foreach($allStatuses as $value => $label)
                                <option value="{{ $value }}"
                                        @if($ticket->status == $value) selected @endif>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Изменить статус</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h6>{{ $ticket->topic }}</h6>
                <div class="mb-3 bg-light p-3 rounded">
                    {!! $ticket->text !!}
                </div>
            </div>
        </div>

        @if($ticket->getFiles()->count() > 0)
            <div class="card mb-3">
                <div class="card-body">
                    <h6>Файлы:</h6>
                    @foreach($ticket->getFiles() as $file)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $file->file_name }}</span>
                            <a href="{{ $ticket->getFileDownloadUrl($file) }}"
                               class="btn btn-sm btn-outline-primary">
                                Скачать
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        <div class="card mb-3">
            <div class="card-body">
                <h6>Клиент:</h6>
                <p><strong>{{ $ticket->customer->name }}</strong></p>
                <p><a href="tel:{{ $ticket->customer->phone }}">{{ $ticket->customer->phone }}</a></p>
                <p><a href="mailto:{{ $ticket->customer->email }}">{{ $ticket->customer->email }}</a></p>
            </div>
        </div>
    </div>
@endsection
