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

  private checkStatus: boolean = false;
  private premium: PremiumModel[] = [];

  constructor(
    private premiumReqService: PremiumReqService,
    private authenticationService: AuthenticationService
  ) { }

 ngOnInit() {

  this.getPremiumPackages();

  }

   checkPremiumStatus(): boolean{
    if(this.authenticationService.getUser() != null){
      this.checkStatus=this.authenticationService.getUser().getIsPremium();
    }
    return this.checkStatus;
  }


  async getPremiumPackages(): Promise<PremiumModel[]>{
    if(this.checkPremiumStatus()){ 
     await this.premiumReqService.getPremium().then((data) => {

        this.premium = data;
        
       })

    }
    return this.premium;
  }
  }

