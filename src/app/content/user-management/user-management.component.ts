import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from 'src/app/authentication.service';
import { User } from 'src/app/User';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-management',
  templateUrl: './user-management.component.html',
  styleUrls: ['./user-management.component.css']
})
export class UserManagementComponent implements OnInit {
  user: User;

  firstname: String;
  name: String;
  gender: String;
  street: String;
  housenumber: number;
  postalcode: number;
  city: String;
  birthday: Date;
  username: String;
  email: String;
  emailConfirm: String;
  password: String;
  passwordConfirm: String;

  constructor(
    private router: Router,
    private authenticationService: AuthenticationService,
  ) { }

  ngOnInit(): void {
    this.getUser();
    this.setValue();
  }

  async getUser(){
    //const id = +this.route.snapshot.paramMap.get('id');
    this.user = this.authenticationService.getUser();
    console.log(this.user);
  }

  safe(){

  }

  setValue() {
    this.firstname = this.user.getFirstname();
    this.name = this.user.getName();
    this.gender = this.user.getGender();
    this.street = this.user.getStreet();
    this.housenumber = this.user.getHouseNumber();
    this.postalcode = this.user.getPostalcode();
    this.city = this.user.getCity();
    this.birthday = this.user.getBirthday();
    this.username = this.user.getUsername();
    this.email = this.user.getEmail();
  }

}


