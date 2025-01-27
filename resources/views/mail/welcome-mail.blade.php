@component("mail::message")

# Welcome {{ $name }}!!

@component("mail::button", ["url" => "https://google.com"])
Button text
@endcomponent

@component("mail::panel")
This is a panel
@endcomponent

## Table Component:

@component("mail::table")
| Laravel | Table | Example |
| ------ | :-----: | :-----: |
| Col 2 is | Centered | $10 |
| Col 2 is | Right-Aligned | $20 |
@endcomponent

@component("mail::subcopy")
This is a sub copy component
@endcomponent

Thanks, <br>
{{ config("app.name") }}

@endcomponent