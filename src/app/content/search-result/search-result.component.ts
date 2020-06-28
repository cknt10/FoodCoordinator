import { Component, OnInit, Input } from '@angular/core';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { map } from 'rxjs/operators';
import { RecipeAdministrationReqService } from 'src/app/recipe-administration-req.service';

@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.scss']
})
export class SearchResultComponent implements OnInit {
  results: Recipe[];

  constructor(
    private route: ActivatedRoute,
    private searchReqService: SearchReqService,
    private recipeAdministrationReqService: RecipeAdministrationReqService
  ) { }

  ngOnInit(): void {
  }
  /*async ngOnInit() {
    //console.log(await this.searchReqService.getUserResults());
    console.log(this.searchReqService.getUserResults());
  }
  }*/

  throwError() {
    console.log(this.recipeAdministrationReqService.getErrorMessage());
    //window.alert(this.error);
  }



/*getRecipe(): void {
    const title = map.get('title');
    this.searchReqService.getUserResults(title)
      .then(recipe => this.recipe = recipe);
  }
*/
}
