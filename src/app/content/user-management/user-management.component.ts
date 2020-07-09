import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from './../../authentication.service';
import { UserManagementServiceReqService } from './../../user-management-service-req.service';
import { User } from '../../User';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-management',
  templateUrl: './user-management.component.html',
  styleUrls: ['./user-management.component.css'],
})
export class UserManagementComponent implements OnInit {
  user: User;

  firstname: String;
  name: String;
  gender: String;
  street: String;
  houseNumber: String;
  postalCode: number;
  city: String;
  birthday: Date;
  username: String;
  email: String;
  emailConfirm: String; // finde ich nicht nötig
  password: string; // sollte, da man es ohnehin nicht shene kann und nicht weiß was drin ist, leer lassen
  passwordConfirm: String; //Kontrolle der beiden n icht vergessen :)
  picture: String;

  fileToUpload: File = null;
  imageUrl: String = '';

  constructor(
    private router: Router,
    private authenticationService: AuthenticationService,
    private userManagement: UserManagementServiceReqService
  ) {}

  ngOnInit(): void {
    this.getUser();
    this.setValue();
  }

  async getUser() {
    //const id = +this.route.snapshot.paramMap.get('id');
    this.user = this.authenticationService.getUser();
    console.log(this.user);
  }

  handleFileInput(file: FileList) {
    this.fileToUpload = file.item(0);

    //Show image preview
    var reader = new FileReader();
    reader.readAsDataURL(this.fileToUpload);
    let text = reader;
    reader.onload = (event: any) => {
      console.log(text.result);
      this.imageUrl = <string>text.result;
      this.picture = <string>text.result;
    };
  }

  async safePassword() {
    await this.userManagement.postchangePassword(
      this.password,
      this.user.getId()
    );
  }

  setValue() {
    this.firstname = this.user.getFirstname();
    this.name = this.user.getName();
    this.gender = this.user.getGender();
    this.street = this.user.getStreet();
    this.houseNumber = this.user.getHouseNumber();
    this.postalCode = this.user.getPostalcode();
    this.city = this.user.getCity();
    this.birthday = this.user.getBirthday();
    this.username = this.user.getUsername();
    this.email = this.user.getEmail();
    this.imageUrl = this.user.getPicture();
    console.log(this.user);
  }

  async safe() {
    if (
      this.password == this.passwordConfirm &&
      this.email == this.emailConfirm
    ) {
      console.log(this.user);
      await this.userManagement.changeUserData(
        this.user.getId(),
        this.username,
        this.firstname,
        this.name,
        this.gender,
        this.street,
        this.houseNumber,
        this.postalCode,
        this.city,
        this.birthday,
        this.email,
        this.picture
      ).then((data) =>{
        this.setUser()
      });

        console.log(this.user);
        window.alert('Ihre Daten wurden erfolgreich geändert.');
      } else {
        window.alert(
          'Bitte alle Felder ausfüllen oder die Email / das Passwort überprüfen.'
        );
      }
    }
  

    setUser(){
       //@Frontend, wenn erfolreich dann set-Methode um die lokalen Werte des Users zu überschreiben
       if (this.userManagement.getErrorMessage() == undefined) {
        this.user = this.authenticationService.changeUserdata(
          this.username,
          this.firstname,
          this.name,
          this.gender,
          this.street,
          this.houseNumber,
          this.postalCode,
          this.city,
          this.birthday,
          this.email,
          this.picture
        );
    }
  }
}
