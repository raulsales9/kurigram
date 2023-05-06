import { TestBed } from '@angular/core/testing';

import { GuardControlGuard } from './guard-control.guard';

describe('GuardControlGuard', () => {
  let guard: GuardControlGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    guard = TestBed.inject(GuardControlGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
