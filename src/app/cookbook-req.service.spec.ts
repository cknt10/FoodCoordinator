import { TestBed } from '@angular/core/testing';

import { CookbookReqService } from './cookbook-req.service';

describe('CookbookReqService', () => {
  let service: CookbookReqService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CookbookReqService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
