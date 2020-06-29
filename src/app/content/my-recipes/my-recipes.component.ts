import { Component, OnInit } from '@angular/core';

import { AuthenticationService } from '../../authentication.service';
import { RecipeAdministrationReqService } from '../../recipe-administration-req.service';
import {PremiumReqService} from '../../premium-req.service'

@Component({
  selector: 'app-my-recipes',
  templateUrl: './my-recipes.component.html',
  styleUrls: ['./my-recipes.component.scss']
})
export class MyRecipesComponent implements OnInit {

  constructor(
    private authenticationService: AuthenticationService,
    private recipeAdministrationService: RecipeAdministrationReqService, 
    private premiumReqService: PremiumReqService
  ) { }

  async ngOnInit() {
    if (this.authenticationService.getUser() != null){
      await this.recipeAdministrationService.getServerUserRecipe(this.authenticationService.getUser());
    }else{
      await this.recipeAdministrationService.getServerUserRecipe(this.premiumReqService.getPremiumUser());

    }
  }

  throwError() {
    console.log(this.recipeAdministrationService.getErrorMessage());
    //window.alert(this.error);
  }

}
