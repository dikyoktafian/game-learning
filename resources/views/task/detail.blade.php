@extends('layouts.app-view')
@section('css')
<link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')

<div id="app">

    {{-- MENU TRIGGER--}}
    <div class="questions-menu" v-on:click="openMenu()">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    {{-- <a class="back btn btn-danger" href="{{ url('task') }}">Back</a> --}}
    {{-- MENU QUESTION --}}
    <div class="container-question hide" v-on:click="closeMenu()">
        <div class="warp-question">
            <div class="row no-gutters">
                {{-- @foreach ($task as $key => $item) --}}
                    <div v-for="(item, index) in data" class="col-6 ques" :data-id="item['id']" data-complate="false" v-on:click="changeQuestion(item['id'])">@{{ index+1 }}</div>
                {{-- @endforeach --}}
            </div>
            <div class="row no-gutters">
                <div class="col-12 mt-3 p-0">
                    <a href="{{ url('task') }}" class="btn btn-outline-secondary w-100 mb-2">Cancel</a>
                    @if ($task['membertask'] == null)
                        <button class="btn btn-success w-100" id="submit" v-on:click="submit()">Submit</button>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="container task detail">
        <div class="row" v-for="(item, index) in data" :data-id="item.id" :class="{active : index == 0}">
            <div class="col-lg-8 mx-auto warp-quiz">

                {{-- ROW QUESTION --}}
                <div class="row question">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg">
                                <h2 class="h6">Question @{{ index+1 }}/@{{ data.length }}</h2>
                            </div>
                            <div class="col-lg-2 d-flex justify-content-end">
                                <ion-icon name="information-circle-outline" type="button" class="btn" data-toggle="modal" data-target="#exampleModal"></ion-icon>
                            </div>
                        </div>
                        
                        <img class="img-question" v-if="question.image" :src="'{{ asset('storage/question/') }}/' + question.image" alt="image" width="100%">
                        <h1 class="h5" :class="{ 'no-img' : !item.image }">@{{ item.question }}</h1>
                    </div>
                </div>

                {{-- ROW ANSWER --}}
                <div class="row no-gutters answer mt-5 pt-5">
                    <div class="col-6 pr-2 pb-3" v-for="(itemx, indexx) in item.answer">
                        <div v-if="!answered" :class="'custom-control custom-radio ques-' + item.id + ' ans-'+itemx.id" v-on:click="clickAnswer(itemx.id, itemx.label, item.id)">
                            <input type="radio" :id="'radio-'+itemx.id" :name="'question-'+item.id"
                                class="custom-control-input">
                            <label class="custom-control-label" :style="{backgroundColor: color[indexx]['hex']}" :for="'radio-'+itemx.id">@{{ itemx.answer }}</label>
                        </div>
                        <div v-else class="custom-control custom-radio" v-on:click="clickAnswer(itemx.id, itemx.label)" :class="{'active' : itemx.correct, 'answer' : itemx.id === answered.answer[index].answer_id}">
                            <input type="radio" :id="'radio-'+itemx.id" :name="'question-'+item.id"
                                class="custom-control-input">
                            <label class="custom-control-label" :for="'radio-'+itemx.id">@{{ itemx.answer }}</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- modal --}}
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Information</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				{{ $task['summary'] }}
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('vendor/vue/vue.js') }}"></script>
<script>
    var app = new Vue({
            el: '#app',
            data: {
                data : @json($task['question']),
                question : null,
                answer : [],
                answered : @json($task['membertask']),
                color : @json($color)
            },
            created: function () {
                this.question = this.data[0];
            },
            methods : {
                openMenu(){
                    $('.container-question').removeClass('hide');
                },
                closeMenu(){
                    $('.container-question').addClass('hide');
                },
                clickAnswer(answer_id, answer_label, ques_id){
                    $(`.ques-${ques_id}`).removeClass('active');
                    $(`.ans-${answer_id}`).addClass('active');
                    let answer = {
                        question_id : this.question.id,
                        answer_id : answer_id,
                        answer_label : answer_label
                    }
                    let cek = this.answer.findIndex(x => x.question_id == this.question.id);
                    if (cek == -1) {
                        this.answer.push(answer);
                    }else {
                        this.answer[cek] = answer;
                    }

                    this.answer.forEach((v, i) => {
                        $(`.ques[data-id=${v.question_id}]`).attr('data-complate', true);
                    });
                },
                changeQuestion(id){
                    // console.log(id);
                    if(id){
                        this.question = this.data.find(v => v.id === id);
                        $('.task.detail > .row').removeClass('active');
                        $(`.task.detail > .row[data-id=${id}]`).addClass('active');
                    }
                },
                submit(){
                    Swal.fire({
                        title: 'Sudah yakin dengan jawaban kamu?',
                        html: '<ul class="text-left"><li>Cek kembali jawaban kamu!</li><li>Jika disubmit, tidak bisa di edit kembali!</li></ul>',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Submit!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url('/task/store') }}",
                                    data: {
                                        _token : '{{ csrf_token() }}',
                                        answer : this.answer,
                                        task : {
                                            task_id : '{{ $task_id }}'
                                        }
                                    },
                                    error: function(data){
                                        console.log('error', data);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Something went wrong!',
                                        })
                                    },
                                    success: function (data) {
                                        if (data.status) {
                                            Swal.fire({
                                                title: "Submited!",
                                                text: "Jawaban kamu berhasil dikirim!",
                                                type: "success"
                                            }).then(function (res) {
                                                console.log(res);
                                                window.location.href = "/task";
                                            });
                                        }else{
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Oops...',
                                                text: 'Something went wrong!',
                                            })
                                        }
                                    },
                                    dataType: 'json'
                                });
                            }
                    })
                }
            }
        })

</script>
@endsection