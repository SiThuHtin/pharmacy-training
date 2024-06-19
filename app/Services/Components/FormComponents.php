<?php

namespace App\Services\Components;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;

class FormComponents
{
    public static function userNameInput(){
        return TextInput::make("name")
        ->required()
        ->placeholder('Please enter username');
    }

    public static function userEmailInput(){
        return TextInput::make("email")
        ->required()
        ->email()
        ;
    }

    public static function userPasswordInput(){
        return  TextInput::make('password')
        ->required(fn($livewire) => $livewire instanceof CreateUser) //to make require only in create users
        ->password()
        ->revealable()
        ->dehydrateStateUsing(fn ($state) => Hash::make($state)) // dehydrate(store) password data in hashed state
        ->confirmed()
        ->dehydrated(fn($state)=>filled($state));   //to protect data filling null in password field in edit State
    }

    public static function userPasswordConfirmationInput(){
        return  TextInput::make('password_confirmation')
        ->required(fn($livewire) => $livewire instanceof CreateUser) //to make require only in create users
        ->label('Confirm Password')
        ->password()
        ->revealable()
        ->dehydrated(false);
    }

    public static function userAdminInput(){
        return Toggle::make('is_admin')->label('Make this user admin');
    }
    public static function userPositionInput(){
        return TextInput::make('position');
    }

    public static function userAvatarUpload(){
        return FileUpload::make('avatar')->avatar()->imageEditor()->directory('avatars');
    }

    public static function userWarehouseSelect(){
        return Select::make('warehouse_id')->label('Warehouse');
    }

    public static function countrySelect(){
        return Select::make('country')
        ->required()
        ->placeholder('Please Select Country')
        ->options([
            'Burma'=> 'Burma',
            'Thailand'=>'Thailand',

        ])
        ->native(false);
    }

    public static function stateInput(){
        return TextInput::make('name')
        ->required()
        ->label(__('State/Division/Province'))
        ->placeholder('Please Enter State/Division/Province')
        ->maxLength(255);
    }
}