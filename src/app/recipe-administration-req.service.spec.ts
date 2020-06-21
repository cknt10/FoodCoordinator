import { TestBed } from '@angular/core/testing';

import { RecipeAdministrationReqService } from './recipe-administration-req.service';

describe('RecipeAdministrationReqService', () => {
  let service: RecipeAdministrationReqService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RecipeAdministrationReqService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
