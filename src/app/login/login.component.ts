import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  username: string;
  password: string;

  constructor() { }

  ngOnInit(): void {
  }

  loginUser(){
    if (this.username == "test" && this.password == "test"){
      window.alert ("Sie sind nun eingeloggt!");
      this.username = "";
      this.password = "";
    }
    else{
      window.alert ("Falsche Login Daten, bitte versuchen Sie es erneut!");
      this.username = "";
      this.password = "";
    }
  }

}
