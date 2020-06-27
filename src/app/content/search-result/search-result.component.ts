import { Component, OnInit, Input } from '@angular/core';
import { SearchReqService } from '../../search-req.service';
import { Recipe } from 'src/app/recipe';
import { ActivatedRoute } from '@angular/router';
import { map } from 'rxjs/operators';

@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.scss']
})
export class SearchResultComponent implements OnInit {
  @Input() recipes: Recipe;
  results: [];
  title: string;
  description: string;
  ratings: number;
  ratingCount: number;
  imgSrc: string;
  certified: boolean;

  constructor(
    private route: ActivatedRoute,
    private searchReqService: SearchReqService,
  ) { }

  ngOnInit(): void {

  }

/*getRecipe(): void {
    const title = map.get('title');
    this.searchReqService.getUserResults(title)
      .then(recipe => this.recipe = recipe);
  }
*/
}
