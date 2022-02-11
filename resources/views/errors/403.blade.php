@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', "You're not authorised to access this resources")
