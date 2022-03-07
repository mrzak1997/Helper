import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  menu_item = ['منو','منو','منو','منو','منو ',]
  constructor() { }

  ngOnInit(): void {
  }

}
