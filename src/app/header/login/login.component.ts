import { Component, OnInit } from '@angular/core';
import { AuthenicationService } from '../../authenication.service'
import { User } from '../../User';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  username: String;
  password: String;

  constructor(private wert: AuthenicationService) { }

  ngOnInit(): void {
  }

  loginUser(){

    console.log('start logging');

    console.log(this.wert.gethim().username);



    console.log("login successfull");



   /* if (this.username == "test" && this.password == "test"){
      window.alert ("Sie sind nun eingeloggt!");
      this.username = "";
      this.password = "";
    }
    else{
      window.alert ("Falsche Login Daten, bitte versuchen Sie es erneut!");
      this.username = "";
      this.password = "";
    }*/
  }

}
