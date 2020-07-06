import { Component, OnInit } from '@angular/core';
import { PremiumReqService } from '../../premium-req.service';
import { AuthenticationService } from '../../authentication.service';
import { PremiumModel } from '../../PremiumModel'

@Component({
  selector: 'app-benefits',
  templateUrl: './benefits.component.html',
  styleUrls: ['./benefits.component.scss']
})
export class BenefitsComponent implements OnInit {

  checkStatus: boolean = false;
  premium: PremiumModel[] = [];

  constructor(
    private premiumReqService: PremiumReqService,
    private authenticationService: AuthenticationService
  ) { }

 async ngOnInit() {

    if(this.checkPremiumStatus()){
      await this.premiumReqService.getPremium().then((data: PremiumModel[]) => {
        this.premium = data;
       })
       console.log(this.premium);
    }
  }

  checkPremiumStatus(): boolean{
    if(this.authenticationService.getUser() != null){
      this.checkStatus=this.authenticationService.getUser().getIsPremium();
    }
    return this.checkStatus;
    }
  }

