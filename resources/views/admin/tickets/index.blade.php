@extends('layouts.admin')

@section('content')
    <div class="container mt-4 tickets-list">

        <form method="GET" action="{{ route('tickets.index') }}" class="row g-3  mb-4 p-3 bg-white border rounded">
            <div class="col-md-3">
                <label class="form-label ">статус</label>
                <select name="status" class="form-select">
                    <option value="">все</option>
                    <option value="1" @if(request('status') === '1') selected @endif>новый</option>
                    <option value="2" @if(request('status') === '2') selected @endif>в работе</option>
                    <option value="3" @if(request('status') === '3') selected @endif>обработан</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label ">дата от</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label ">дата до</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label class="form-label ">email / телефон</label>
                <input name="email" placeholder="email" value="{{ request('email') }}" class="form-control  mb-2">
                <input name="phone" placeholder="Телефон" value="{{ request('phone') }}" class="form-control">
            </div>

            <div class="col-12 d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-primary">применить</button>
                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">сбросить</a>
            </div>
        </form>


        <div class="table">
            <table class="table" id="operations-table">
                <thead>
                <tr>
                    <th></th>
                    <th>email</th>
                    <th>телефон</th>
                    <th>тема</th>
                    <th>статус</th>
                    <th>создано</th>
                    <th>дата ответа</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->customer->email ?? '-' }}</td>
                        <td>{{ $ticket->customer->phone ?? '-' }}</td>
                        <td>{{ Str::limit($ticket->topic, 40) }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $ticket->date_of_response->format('d.m.Y')   }}</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket) }}" class="">открыть</a>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>

            @auth
                <a class="navbar-brand" href="{{ url('/') }}">
                    ballance: <span id="main-balance">{{ $user->balance->balance }}</span>
                </a>
            @endauth
        </div>

        <div class="p-3">
            {{ $tickets->links() }}
        </div>
    </div>
@endsection
