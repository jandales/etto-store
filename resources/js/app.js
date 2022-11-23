import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
  resolve: async name => {
    const comps = import.meta.glob('./Pages/**/*.vue');
    const match = comps[`./Pages/${name}.vue`];
    const page = (await import(/* @vite-ignore */ `${match.name}`)).default;
    return page;

  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})



InertiaProgress.init()



