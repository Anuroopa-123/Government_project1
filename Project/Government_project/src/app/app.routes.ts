import { Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { NavbarComponent } from './navbar/navbar.component';
import { HeroComponent } from './hero/hero.component';
import { UnionStateRelationsComponent } from './union-state-relations/union-state-relations.component';
import { AboutCommitteeComponentComponent } from './about-committee-component/about-committee-component.component';
import { HeaderComponent } from './header/header.component';
import { AssemblyPageComponent } from './assembly-page/assembly-page.component';
import { PressreleaseComponent } from './pressrelease/pressrelease.component';
import { RegistrationComponent } from './registration/registration.component';

export const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'header', component: HeaderComponent },
  { path: 'navbar', component: NavbarComponent },
  { path: 'hero', component: HeroComponent },
  { path: 'unionstaterelations', component: UnionStateRelationsComponent },
  { path: 'committee', component: AboutCommitteeComponentComponent },
  { path: 'assembly', component: AssemblyPageComponent },
  { path: 'press-release', component: PressreleaseComponent },
  { path: 'login', component: RegistrationComponent },
];
