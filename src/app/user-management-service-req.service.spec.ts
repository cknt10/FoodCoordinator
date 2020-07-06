import { TestBed } from '@angular/core/testing';

import { UserManagementServiceReqService } from './user-management-service-req.service';

describe('UserManagementServiceReqService', () => {
  let service: UserManagementServiceReqService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(UserManagementServiceReqService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
