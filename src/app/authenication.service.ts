import { Injectable } from '@angular/core';
import { LoginReqService } from './login-req.service';
import { Subscription, Observable } from 'rxjs';
import { User } from './User';


@Injectable({
  providedIn: 'root'
})
export class AuthenicationService {


private UserData: User;

  constructor(private reqService: LoginReqService) { }


setUserData(){

  console.log('Beziehe Daten aus Http_Request Methode aus login.service');

  this.reqService.getServerLoginData().subscribe((data: User) => {
    this.UserData= data;
  }, error =>{ console.log('Konvertierung klappt nicht')}
  );
  console.log("Zuweisung des Users und Konvertierung in Array erfolgreich");


}

  getUser() {


    this.setUserData();

    console.log("Wert vergeben erfolreich");

    return this.UserData.name;
}




}
