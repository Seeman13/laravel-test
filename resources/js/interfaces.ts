export interface IBrand {
  id: number
  name: string
  alias: string
  image?: string
}

export interface IPhoto {
  car_id: number
  image: string
  sort?: string
}

export interface ICar {
  id: number
  brand_id: number
  vendor_code: string
  release: number
  engine: string
  transmission?: boolean
  price: number
  alias: string
  description?: string
  views?: number
  brand: IBrand
  photo: IPhoto
}

export interface ILink {
  url: string
  label: string
  active: boolean
}

export interface IData {
  items: ICar[]
  links: ILink[]
  total_last_items: number
}

export interface IForm {
  brand?: string
  vendor_code?: string
  yearStart?: string
  yearEnd?: string
  engine?: string
  transmission?: string
  priceStart?: string
  priceEnd?: string
  q?: string
}
