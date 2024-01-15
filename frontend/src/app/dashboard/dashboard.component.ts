import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { Emitters } from '../emitters/emitters';
import { FormBuilder, FormGroup } from '@angular/forms';
import { IDropdownSettings } from 'ng-multiselect-dropdown';


@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  message = '';
  messageType = '';
  formSimulate: FormGroup;
  formNewTeam: FormGroup;
  dropdownList: object[] = [];
  selectedItems: object[] = [];
  dropdownSettings: IDropdownSettings;

  constructor(private http: HttpClient, private formBuilder: FormBuilder) {
    
  }

  ngOnInit(): void {
    this.formSimulate = this.formBuilder.group({
      'championshipName': '',
      'teams': ''
    });

    this.formNewTeam = this.formBuilder.group({
      'teamName': ''
    });

    this.execEmmiter();
    this.getTeams();
    this.selectedItems = [];

    this.dropdownSettings = {
      singleSelection: false,
      idField: 'id',
      textField: 'name',
      selectAllText: 'Selecionar todos',
      unSelectAllText: 'Nenhum',
      searchPlaceholderText: 'Buscar',
      itemsShowLimit: 8,
      limitSelection: 8,
      allowSearchFilter: true,
      noDataAvailablePlaceholderText: 'Nenhum time cadastrado'
    };
  }

  onItemSelect(item: any) {  
  }

  onSelectAll(item: any) {
  }

  execEmmiter(): void {
    this.http.get('http://localhost:3000/api/user', {withCredentials: true}).subscribe(
      (res: any) => {
        Emitters.authEmitter.emit(true);
      },
      err => {
        this.message = "Você não está autenticado para prosseguir";
        Emitters.authEmitter.emit(false);
      }
    );
  }

  getTeams(): void {
    this.http.get('http://localhost:3000/api/teams/all', {withCredentials: true}).subscribe(
      (res:any) => {        
        if (res.data)
          this.dropdownList = res.data;
        else 
          this.dropdownList = [];
      }
    )
  }

  registerTeam(): void {
    this.http.post('http://localhost:3000/api/teams/new', this.formNewTeam.getRawValue(), {withCredentials: true}).subscribe(
      (res: any) => {
        this.message = res.message
        this.messageType = 'success'
        this.dropdownList.push(res.data);
        setTimeout(() => {
          location.reload()
        }, 1500)
      }, err => {
        this.messageType = 'danger'
        this.message = err.message
        console.log(err);
      }
    )
  }

  submit(): void {
    console.log(this.formSimulate.getRawValue());
    
    this.http.post('http://localhost:3000/api/simulate', this.formSimulate.getRawValue(), {withCredentials: true}).subscribe(
      (res:any) => {        
        console.log(res);
        
      }
    )
  }
}
