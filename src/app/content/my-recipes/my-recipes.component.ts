import { Component, OnInit } from '@angular/core';

import { AuthenticationService } from '../../authentication.service';
import { RecipeAdministrationReqService } from '../../recipe-administration-req.service';

@Component({
  selector: 'app-my-recipes',
  templateUrl: './my-recipes.component.html',
  styleUrls: ['./my-recipes.component.scss']
})
export class MyRecipesComponent implements OnInit {

  constructor(
    private authenticationService: AuthenticationService,
    private recipeAdministrationService: RecipeAdministrationReqService
  ) { }

  async ngOnInit() {
    await this.recipeAdministrationService.getServerUserRecipe(this.authenticationService.getUser());
  }

  throwError() {
    console.log(this.recipeAdministrationService.getErrorMessage());
    //window.alert(this.error);
  }

}
