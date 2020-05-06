@extends('layout')
@section('title', $query->name)
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h3><i class="fas fa-question"></i> Sorğu - {{ $query->name }} </h3>
        <hr>
        <form action="{{ url('') }}" method="post" class="queryForm">
            @csrf
            <input type="hidden" name="_query" value="{{ $query->id }}">
            @foreach($questions as $key => $question)
            <div class="form-group">
                <h4><strong class="text-danger">Sual {{ $key+1 }}</strong> {{ $question->body }}</h4>
                @foreach($questionClass->find($question->id)->answer as $answer)
                <ul class="answers">
                    <li>
                        <label class="form-check-label" for="{{ $answer->id }}">
                          <input type="radio" name="{{ $question->id }}" id="{{ $answer->id }}" value="{{ $answer->id }}"
                          @if($resultClass->where('question_id','=',$question->id)->exists())
                              @if($resultClass->where('question_id','=',$question->id)->first()->answer_id == $answer->id)
                              checked
                              @endif
                          @endif>
                          <span class="dot"></span> {{ $answer->body }}
                        </label>
                    </li>
                </ul>
                @endforeach
            </div>
            @endforeach
            <hr>
            @if($query->result == -1)
            <button class="btn btn-sm btn-success rs result"><i class="fas fa-check"></i> Hazır</button>
            <button class="btn btn-sm btn-warning rs save"><i class="fas fa-save"></i> Saxla</button>
            @else
            <span class="p-2 bg-secondary text-white">Nəticə: {{ $query->result.'/'.$query->count.' ('.round($query->result/$query->count * 100,1).'%)' }}</span>
            @endif
        </form>
    </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="statusModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 id="status"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" onClick="window.location.reload()">Bağla</button>
      </div>
    </div>
  </div>
</div>
@endsection