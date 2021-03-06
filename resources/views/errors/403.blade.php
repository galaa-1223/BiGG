@extends('errors::minimal')

@section('title', __('Хориотой'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Хориотой'))
