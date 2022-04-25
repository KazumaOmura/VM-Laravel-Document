<?php
class HelloController extends Controller
{
    public function index($message) {
        return view('hello.index', ['msg'=>$message]);
    }
}