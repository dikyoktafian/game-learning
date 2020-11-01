@extends('layouts.app-view')
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')

    <div id="app">

        {{-- MENU --}}
        <div class="questions-menu" v-on:click="openMenu()">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container-question hide" v-on:click="closeMenu()">
            {{-- ROW QUESTION --}}
            <div class="warp-question">
                <div class="row no-gutters">
                    @foreach ($task as $key => $item)
                        <div class="col-6" data-complate="false" v-on:click="changeQuestion({{$item['id']}})">{{ $key+1 }}</div>
                    @endforeach
                </div>
                <div class="row no-gutters">
                    <div class="col-12 mt-3 p-0">
                        <button class="btn btn-success w-100" id="submit" v-on:click="submit()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    
        
        <div class="container task detail">
            <div class="row">
                <div class="col-lg-8 mx-auto warp-quiz">
    
                    {{-- ROW QUESTION --}}
                    <div class="row question">
                        <div class="col-lg-12">
                            <h2 class="h6">Question 1/10</h2>
                            <img v-if="question.image" src="https://via.placeholder.com/800x400" alt="image" width="100%">
                            <h1 class="h5" :class="{ 'no-img' : !question.image }">@{{ question.question }}</h1>
                        </div>
                    </div>
    
                    {{-- ROW ANSWER --}}
                    <div class="row no-gutters answer">
                        <div class="col-6 pr-2 pb-3" v-for="(item, index) in question.answer">
                            <div class="custom-control custom-radio" :data-id="item.id" v-on:click="clickAnswer(item.id, item.label)" :class="answerActive(item.id)">
                                <input type="radio" :id="'answer-'+index" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" :for="'answer-'+index">@{{ item.answer }}</label>
                            </div>
                        </div>
                    </div>
                    
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
                data : @json($task),
                question : null,
                answer : []
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
                clickAnswer(answer_id, answer_label){
                    console.log(answer_id);
                    $('.custom-control').removeClass('active');
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
                    // $(`[data-id=${answer_id}]`).addClass('active');
                    // this.answerActive([1,8])
                    // $(this).addClass('active');
                    // localStorage.setItem('key', 'value')
                },
                answerActive(id) {
                    // let a = this.answer.map(v => v.answer_id);
                    // console.log(a);
                    this.answer.forEach(v => {
                        return {
                            active : id == v.answer_id
                        }
                    });
                    // return [{active : id == 1}, {active : id == 7}]
                },
                changeQuestion(id){
                    if(id){
                        this.question = this.data.find(v => v.id === id)
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
                        if (result.value) {
                            Swal.fire(
                            'Submited!',
                            'Jawaban kamu berhasil dikirim!',
                            'success'
                            )
                        }
                    })
                }
            }
        })

        // $(document).on('click', '.custom-control', function () {
        //     $('.custom-control').removeClass('active');
        //     $(this).addClass('active');
        // });

    </script>
@endsection