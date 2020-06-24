import { Component, OnInit } from '@angular/core';
import { SearchReqService } from '../../search-req.service';

@Component({
  selector: 'app-search-result',
  templateUrl: './search-result.component.html',
  styleUrls: ['./search-result.component.css']
})
export class SearchResultComponent implements OnInit {

  results: [];
  title: string;
  descr: string;
  rating: number;
  ratingCount: number;
  imgSrc: string;
  certi: boolean;

  constructor(
    private searchReqService: SearchReqService,
  ) { }

  ngOnInit(): void {
  }



}
